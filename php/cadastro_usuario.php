<!DOCTYPE html>
<html>

<head>
	<title>Cadastro</title>
	<link rel="stylesheet" href="/css/cadastro_usuario.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>

<body>
	<header>
		<a href="login.php" class="voltar">&lt; Voltar</a>
	</header>
	<main>
		<form method="POST">
			<h2>Cadastre-se</h2>
			<label for="nome">Nome:</label>
			<input type="text" id="nome" name="nome" required>

			<label for="email">E-mail:</label>
			<input type="email" id="email" name="email" required>

			<label for="senha">Senha:</label>
			<input type="password" id="senha" name="senha" required>

			<label for="nascimento">Data de nascimento:</label>
			<input type="date" id="nascimento" name="nascimento" required>

			<label for="sexo">Sexo:</label>
			<select id="sexo" name="sexo" required>
				<option value="masculino">Masculino</option>
				<option value="feminino">Feminino</option>
				<option value="outro">Outro</option>
			</select>

			<div class="container_botao"><input class="enviar" type="submit" value="Enviar"></div>
		</form>
	</main>

	<?php
	$servidor = "localhost";
	$usuario = "root";
	$senha = "#userVL2023";
	$banco = "gymplanner2";

	$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

	if (!$conexao) {
		die("Falha na conexão: " . mysqli_connect_error());
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$nome = $_POST["nome"];
		$email = $_POST["email"];
		$senha = $_POST["senha"];
		$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

		$nascimento = $_POST["nascimento"];
		$sexo = $_POST["sexo"];

		$consulta = "INSERT INTO usuarios (nome, email, senha, nascimento, sexo) VALUES ('$nome', '$email', '$senha_hash', '$nascimento', '$sexo')";

		if (mysqli_query($conexao, $consulta)) {
			echo "Dados inseridos com sucesso!";
		} else {
			echo "Erro ao inserir dados: " . mysqli_error($conexao);
		}
	}

	// Fecha a conexão com o banco de dados
	mysqli_close($conexao);
	?>
</body>

</html>