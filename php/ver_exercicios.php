<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/menu_navegacao.css">
    <link rel="stylesheet" href="/css/ver_exercicios.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="nav-bar">
        <a class="menu-inicial" href="tela_inicial.php">Início</a>
        <a href="montar_cronograma.php">Cronograma</a>
        <a href="calcular_imc.php">IMC</a>
        <a href="saiba_mais.php">Saiba Mais</a>
        <a href="conhecimento.php">Sobre</a>
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
        $consultaUsuario = "SELECT foto_perfil FROM usuarios WHERE email = '$email'";
        $resultadoUsuario = mysqli_query($conexao, $consultaUsuario);
        if (mysqli_num_rows($resultadoUsuario) == 1) {
            $usuario = mysqli_fetch_assoc($resultadoUsuario);
            $foto_perfil = $usuario['foto_perfil'];
        }
        mysqli_close($conexao);
        ?>
        <a href="/php/perfil_usuario.php"><img src="<?php echo $foto_perfil; ?>" alt="Foto de Perfil"></a>
    </nav>
    <main>
        <?php
        $servidor = "localhost";
        $usuario = "root";
        $senha = "#userVL2023";
        $banco = "gymplanner2";
        $conn = mysqli_connect($servidor, $usuario, $senha, $banco);
        if (!$conn) {
            die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
        }
        $query = "SELECT * FROM exercicios";
        $resultado = mysqli_query($conn, $query);
        if (mysqli_num_rows($resultado) > 0) {
            while ($row = mysqli_fetch_assoc($resultado)) {
                $categoria = $row["categoria"];
                $nome = $row["nome"];
                $series = $row["series"];
                $repeticao = $row["repeticao"];
                $tempo = $row["tempo"];
                $imagem = $row["imagem"];
                $orientacao = $row["orientacao"];
                echo '<div class="grid">';
                echo '<div class="div1">';
                echo '<h1>' . $nome . '</h1>';
                echo '<h2> Categoria: ' . $categoria . '</h2>';
                echo '<img width="320px" src="../img/gifs_exercicios/' . $imagem . '" alt="' . $nome . '">';
                echo '<h3>Series: ' . $series . ' | Repetição: ' . $repeticao . ' | Tempo: ' . $tempo . '</h3>';
                echo '</div>';
                echo '<div class="div2">
                    <p>Como fazer: <br>' . $orientacao . '</p>
                </div>';
                echo '</div>';
            }
        } else {
            echo "Nenhum resultado encontrado.";
        }
        mysqli_close($conn);
        ?>
    </main>

</body>

</html>