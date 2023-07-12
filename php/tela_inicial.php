<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem vindo(a)</title>
    <link rel="stylesheet" href="/css/tela_inicial.css">
    <link rel="stylesheet" href="/css/menu_navegacao.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    // Realize a conexão com o banco de dados
    $servidor = "localhost";
    $usuario = "root";
    $senha = "#userVL2023";
    $banco = "gymplanner2";

    $conn = mysqli_connect($servidor, $usuario, $senha, $banco);

    // Verifique se a conexão foi estabelecida corretamente
    if (!$conn) {
        die("Erro na conexão com o banco de dados: " . mysqli_connect_error());
    }

    // Inicie a sessão
    session_start();

    // Verifique se o email está presente na sessão
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];

        // Consulta para buscar o usuário com base no email
        $consulta = "SELECT foto_perfil FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($conn, $consulta);

        // Verifique se a consulta retornou resultados
        if (mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_assoc($resultado);
            $foto_perfil = $row['foto_perfil'];

            // Defina a foto de perfil no atributo "src" da tag <img>
            echo '<nav class="nav-bar">';
            echo '<a href="montar_cronograma.php">Cronograma</a>';
            echo '<a href="ver_exercicios.php">Exercícios</a>';
            echo '<a href="calcular_imc.php">IMC</a>';
            echo '<a href="saiba_mais.php">Saiba Mais</a>';
            echo '<a href="conhecimento.php">Sobre</a>';
            echo '<a href="perfil_usuario.php"><img src="' . $foto_perfil . '" alt="Foto de Perfil"></a>';
            echo '</nav>';
        } else {
            // Se o usuário não for encontrado, você pode exibir uma imagem padrão ou tratar de outra maneira
            echo '<nav class="nav-bar">';
            echo '<a href="montar_cronograma.php">Cronograma</a>';
            echo '<a href="ver_exercicios.php">Exercícios</a>';
            echo '<a href="calcular_imc.php">IMC</a>';
            echo '<a href="saiba_mais.php">Saiba Mais</a>';
            echo '<a href="conhecimento.php">Sobre</a>';
            echo '<a href="perfil_usuario.php"><img src="../img/fotos_de_perfil/profile.png" alt="Foto de Perfil"></a>';
            echo '</nav>';
        }

        mysqli_close($conn); // Feche a conexão com o banco de dados
    }
    ?>

    <h1> Bem - Vindo ao GymPlanner </h1>
    <p>Esta página tem a função de auxiliar o cliente a montar seu cronograma,<br> calcular seu IMC e consultar exercícios que podem ajudar<br> Agradecemos a preferência e aconselhamos o cliente a consultar especialistas para <br>montar um cronograma ainda mais eficiente sem prejudicar sua saúde.</p>
    <img class="rato" src="/img/fotos_site/ezgif.com-video-to-gif.gif" alt="">
</body>

</html>