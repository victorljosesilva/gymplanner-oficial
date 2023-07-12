<?php
session_start();

$servidor = "localhost";
$usuario = "root";
$senha = "#userVL2023";
$banco = "gymplanner2";

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}

$email = $_SESSION["email"];

$consulta = "SELECT * FROM usuarios WHERE email = '$email'";
$resultado = mysqli_query($conexao, $consulta);

if (mysqli_num_rows($resultado) == 1) {
    $usuario = mysqli_fetch_assoc($resultado);
    $dataNascimento = new DateTime($usuario["nascimento"]);
    $hoje = new DateTime();
    $idade = $hoje->diff($dataNascimento)->y;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["excluir"])) {
            mysqli_query($conexao, "SET FOREIGN_KEY_CHECKS = 0");

            $excluirConta = "DELETE FROM usuarios WHERE email = '$email'";
            mysqli_query($conexao, $excluirConta);

            mysqli_query($conexao, "SET FOREIGN_KEY_CHECKS = 1");

            header("Location:/index.php");
            exit();
        }

        if (isset($_POST["enviar"]) && isset($_FILES["arquivo"])) {
            $idUsuario = $usuario["id"];
            $diretorio = "../img/fotos_de_perfil/"; // Diretório onde a imagem será salva
            $nomeArquivo = $_FILES["arquivo"]["name"];
            $caminhoCompleto = $diretorio . $nomeArquivo;

            if (move_uploaded_file($_FILES["arquivo"]["tmp_name"], $caminhoCompleto)) {
                $atualizarFoto = "UPDATE usuarios SET foto_perfil = '$caminhoCompleto' WHERE id = $idUsuario";
                mysqli_query($conexao, $atualizarFoto);

                header("Location:/php/perfil_usuario.php");
                exit();
            }
        }

        if (isset($_POST["remover_foto"])) {
            $idUsuario = $usuario["id"];
            $caminhoFoto = $usuario["foto_perfil"];
            $nomeFoto = basename($caminhoFoto);

            if ($nomeFoto !== "profile.png" && unlink($caminhoFoto)) {
                $atualizarFoto = "UPDATE usuarios SET foto_perfil = '../img/fotos_de_perfil/profile.png' WHERE id = $idUsuario";
                mysqli_query($conexao, $atualizarFoto);

                header("Location:/php/perfil_usuario.php");
                exit();
            }
        }
    }
} else {
    header("Location:../index.php");
    exit();
}

mysqli_close($conexao);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Perfil</title>
    <link rel="stylesheet" href="/css/perfil_usuario.css">
    <link rel="stylesheet" href="/css/menu_navegacao.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <nav class="nav-bar">
        <a class="menu-inicial" href="tela_inicial.php">Início</a>
        <a href="ver_exercicios.php">Exercícios</a>
        <a href="montar_cronograma.php">Cronograma</a>
        <a href="calcular_imc.php">IMC</a>
        <a href="saiba_mais.php">Saiba Mais</a>
        <a href="conhecimento.php">Sobre</a>
    </nav>

    <div class="container_geral">
        <div class="container1">
            <div class="div_superior">
                <img class="foto_perfil" id="foto_perfil" src="<?= $usuario["foto_perfil"] ?>" alt="imagem-usuario" onclick="toggleButtons()">
            </div>


            <h1><?php echo $usuario["nome"]; ?></h1><br><br>
            <a href="editar_info.php"><button class="editar">Editar Informações</button></a>
            <form method="post">
                <button class="encerrar"><a href="/index.php">Encerrar Sessão</a></button>
            </form>
            <form method="post" onsubmit="return confirm('Tem certeza de que deseja excluir sua conta?');">
                <button class="excluir" name="excluir">Excluir Conta</button>
            </form>
        </div>
        <form action="perfil_usuario.php" method="POST" enctype="multipart/form-data" id="form_imagem" class="hidden">
            <p>Selecione uma imagem de perfil:</p>
            <input type="file" name="arquivo"> <br>
            <input type="submit" name="enviar" value="Salvar"> <br>
            <input type="submit" name="remover_foto" value="Remover">
        </form>
        <div class="container2">
            <div class="info">E-mail:</div>
            <div class="info_valor"><?php echo $usuario["email"]; ?></div>
            <div class="info">Idade:</div>
            <div class="info_valor"><?php echo $idade; ?></div>
            <div class="info">Sexo:</div>
            <div class="info_valor"><?php echo $usuario["sexo"]; ?></div>
        </div>
    </div>

    <script>
        function toggleButtons() {
            var form = document.getElementById('form_imagem');
            form.classList.toggle('hidden');
        }
    </script>
</body>

</html>