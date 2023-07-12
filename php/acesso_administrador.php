<?php
$servidor = "localhost";
$usuarioDB = "root";
$senhaDB = "#userVL2023";
$banco = "gymplanner2";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$senhaDigitada = $_POST["senha"];

	$conexao = mysqli_connect($servidor, $usuarioDB, $senhaDB, $banco);
	if (!$conexao) {
		die("Falha na conexão: " . mysqli_connect_error());
	}

	$consulta = "SELECT valor FROM senha";
	$resultado = mysqli_query($conexao, $consulta);

	if ($resultado && mysqli_num_rows($resultado) > 0) {
		$linha = mysqli_fetch_assoc($resultado);
		$senhaCorreta = $linha["valor"];

		if ($senhaDigitada == $senhaCorreta) {
			header("Location: gerenciamento.php");
			exit;
		} else {
			$erro = "Senha incorreta. Tente novamente.";
		}
	} else {
		$erro = "Senha não encontrada na tabela.";
	}

	mysqli_close($conexao);
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Acesso Administrador</title>
	<link rel="stylesheet" href="/css/acesso_administrador.css">
</head>

<body>
	<a href="/index.php">voltar</a>
	<h1>Acesso Administrador</h1>
	<?php if (isset($erro)) { ?>
		<p><?php echo $erro; ?></p>
	<?php } ?>
	<form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
		<label for="senha">Insira sua senha de acesso:</label>
		<input type="password" name="senha" id="senha" required>
		<br>
		<input type="submit" value="Acessar">

	</form>
</body>

</html>