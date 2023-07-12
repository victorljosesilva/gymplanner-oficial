<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servidor = "localhost";
    $usuario = "root";
    $senha = "#userVL2023";
    $banco = "gymplanner2";

    $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

    if (!$conexao) {
        die("Falha na conexão: " . mysqli_connect_error());
    }

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $consulta = "SELECT * FROM usuarios WHERE email = '$email'";
    $resultado = mysqli_query($conexao, $consulta);

    if (mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_assoc($resultado);
        $senha_hash = $row["senha"];
        if (password_verify($senha, $senha_hash)) {
            $_SESSION["usuario_id"] = $row["id"];
            $_SESSION["email"] = $email;
            header("Location: tela_inicial.php");
            exit();
        } else {
            $mensagem = "E-mail ou senha inválidos.";
        }
    } else {
        $mensagem = "E-mail ou senha inválidos.";
    }

    mysqli_close($conexao);
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
    <a href="/index.php">voltar</a>
    <div class="form_container">
        <img src="/img/fotos_site/logo.png" alt="">
        <form method="POST">
            <h2>Login</h2>
            <?php if (isset($mensagem)) : ?>
                <p class="erro"><?php echo $mensagem; ?></p>
            <?php endif; ?>
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button class="botao-login" type="submit">Entrar</button>
            <a class="botao-cadastro" href="cadastro_usuario.php">Cadastre-se</a>
        </form>
    </div>
</body>

</html>