<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações</title>
    <link rel="stylesheet" href="/css/conhecimento.css">
    <link rel="stylesheet" href="/css/menu_navegacao.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
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
        $resultadoFotoPerfil = mysqli_query($conn, $consulta);

        // Verifique se a consulta retornou resultados
        if (mysqli_num_rows($resultadoFotoPerfil) > 0) {
            $row = mysqli_fetch_assoc($resultadoFotoPerfil);
            $foto_perfil = $row['foto_perfil'];
        } else {
            // Se o usuário não for encontrado, você pode exibir uma imagem padrão ou tratar de outra maneira
            $foto_perfil = "../img/fotos_de_perfil/profile.png";
        }

        mysqli_close($conn); // Feche a conexão com o banco de dados
    }
    ?>

    <nav class="nav-bar">
        <a class="menu-inicial" href="tela_inicial.php">Início</a>
        <a href="montar_cronograma.php">Cronograma</a>
        <a href="ver_exercicios.php">Exercícios</a>
        <a href="calcular_imc.php">IMC</a>
        <a href="saiba_mais.php">Saiba Mais</a>
        <?php if (isset($foto_perfil)) : ?>
            <a href="/php/perfil_usuario.php"><img src="<?php echo $foto_perfil; ?>" alt="Foto de Perfil"></a>
        <?php endif; ?>
    </nav>
    <div class="container">
        <h1>Sobre o GymPlanner</h1>
        <h2>O Projeto GymPlanner, idealizado e implementado pelos alunos do Instituto Federal Campus Igarassu tem o objetivo de proporcionar aos seus usuários uma experiência única na melhoria de Qualidade de Vida através do Planejamento de exercícios físicos, cálculos do índice de massa corporal (IMC), demonstração de exercícios físicos, séries, repetições, data e conhecimento constante. Nosso projeto ainda visa evoluções futuras que incluem alertas diários e cumprimento de metas.</h2>

        <h3>Colaboradores</h3>
        <ul>
            <li>Nicole Kathlen</li>
            <li>Victor Leonardo</li>
            <li>Arthur Alves</li>
            <li>Gabriel Henrique</li>
            <li>Emanuel Felipe</li>
            <li>João Vitor</li>
        </ul>
    </div>
</body>

</html>