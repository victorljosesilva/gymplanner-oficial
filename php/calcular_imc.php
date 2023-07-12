<?php
if (isset($_POST['confirmado'])) {
    $peso = $_POST['peso'];
    $altura = $_POST['altura'];
    $imc = $peso / ($altura * $altura);

    $resultado = "";

    if ($imc < 18.5) {
        $resultado = "Você está no estado de magreza";
    } elseif ($imc >= 18.5 && $imc <= 24.9) {
        $resultado = "Peso normal";
    } elseif ($imc >= 25 && $imc <= 29.9) {
        $resultado = "Você está no estado de Sobrepeso";
    } else {
        $resultado = "Você está no estado de Obesidade";
    }
} else {
    $peso = 0;
    $altura = 0;
    $imc = 0;
}

$servidor = "localhost";
$usuario = "root";
$senha = "#userVL2023";
$banco = "gymplanner2";

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);

if (!$conn) {
    die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
}

session_start();

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $consulta = "SELECT foto_perfil FROM usuarios WHERE email = '$email'";
    $resultadoFotoPerfil = mysqli_query($conn, $consulta);

    if (mysqli_num_rows($resultadoFotoPerfil) > 0) {
        $row = mysqli_fetch_assoc($resultadoFotoPerfil);
        $foto_perfil = $row['foto_perfil'];
    } else {
        $foto_perfil = "../img/fotos_de_perfil/profile.png";
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMC</title>
    <link rel="stylesheet" href="/css/calcular_imc.css">
    <link rel="stylesheet" href="/css/menu_navegacao.css">
    <style>
    </style>
</head>

<header>
    <nav class="nav-bar">
        <a class="menu-inicial" href="tela_inicial.php">Início</a>
        <a href="montar_cronograma.php">Cronograma</a>
        <a href="ver_exercicios.php">Exercícios</a>
        <a href="saiba_mais.php">Saiba Mais</a>
        <a href="conhecimento.php">Sobre</a>
        <?php if (isset($foto_perfil)) : ?>
            <a href="/php/perfil_usuario.php"><img src="<?php echo $foto_perfil; ?>" alt="Foto de Perfil"></a>
        <?php endif; ?>
    </nav>
</header>

<body>
    <form method="POST">
        <h2>Digite seu peso:</h2>
        <input type="number" name="peso" min="40" placeholder="Digite seu Peso" required> <br>

        <h2>Digite sua altura:</h2>
        <input type="number" step="0.010" name="altura" min="1.40" placeholder="Digite sua altura" required> <br> <br>
        <button type="submit" name="confirmado">Gerar Resultado</button>
        <?php if (isset($_POST['confirmado'])) : ?>
            <h3>Resultado:</h3>
            <p><?php echo $resultado; ?></p>
        <?php endif; ?>
    </form>

    <p>O que é IMC? <a href="https://pt.wikipedia.org/wiki/%C3%8Dndice_de_massa_corporal" target="_blank">Saiba mais</a>.</p>

</body>

</html>