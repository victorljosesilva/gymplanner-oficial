<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="/css/gerenciamento_editar.css">
</head>

<body>
	<div class="espaco">
		<?php
		$servidor = "localhost";
		$usuario = "root";
		$senha = "#userVL2023";
		$banco = "gymplanner2";

		$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

		// Verifica se foi enviado um ID válido
		if (isset($_GET['id']) && !empty($_GET['id'])) {
			$exercicioId = $_GET['id'];

			// Verifica se o formulário foi enviado
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				// Estabelece a conexão com o banco de dados
				$conn = mysqli_connect($servidor, $usuario, $senha, $banco);

				// Verifica se a conexão foi estabelecida corretamente
				if (!$conn) {
					die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
				}

				// Obtém os dados do formulário
				$categoria = $_POST['categoria'];
				$nome = $_POST['nome'];
				$series = $_POST['series'];
				$repeticao = $_POST['repeticao'];
				$tempo = $_POST['tempo'];
				$orientacao = $_POST['orientacao'];

				// Verifica se um arquivo foi enviado
				if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
					$imagem = $_FILES['imagem']['name'];
					$imagem_tmp = $_FILES['imagem']['tmp_name'];

					// Move o arquivo para o diretório desejado
					move_uploaded_file($imagem_tmp, "../img/gifs_exercicios/" . $imagem);
				} else {
					// Mantém a imagem existente se nenhum novo arquivo for enviado
					$query_select_imagem = "SELECT imagem FROM exercicios WHERE id='$exercicioId'";
					$resultado_select_imagem = mysqli_query($conn, $query_select_imagem);
					$row_select_imagem = mysqli_fetch_assoc($resultado_select_imagem);
					$imagem = $row_select_imagem['imagem'];
				}

				// Atualiza os dados do exercício no banco de dados
				$query = "UPDATE exercicios SET categoria='$categoria', nome='$nome', series='$series', repeticao='$repeticao', tempo='$tempo', imagem='$imagem', orientacao='$orientacao' WHERE id='$exercicioId'";
				$resultado = mysqli_query($conn, $query);

				// Verifica se a atualização foi bem-sucedida
				if ($resultado) {
					header("Location: gerenciamento.php");
					exit();
				} else {
					echo '<script>alert("Erro ao atualizar o exercício: ' . mysqli_error($conn) . '"); window.location.reload();</script>';
				}



				// Fecha a conexão com o banco de dados
				mysqli_close($conn);
			} else {
				// Exibe o formulário de edição com os dados atuais do exercício

				// Estabelece a conexão com o banco de dados
				$conn = mysqli_connect($servidor, $usuario, $senha, $banco);

				// Verifica se a conexão foi estabelecida corretamente
				if (!$conn) {
					die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
				}

				// Consulta os dados do exercício com base no ID
				$query = "SELECT * FROM exercicios WHERE id='$exercicioId'";
				$resultado = mysqli_query($conn, $query);

				// Verifica se a consulta retornou resultados
				if (mysqli_num_rows($resultado) > 0) {
					$row = mysqli_fetch_assoc($resultado);

					// Obtém os valores das colunas do resultado
					$categoria = $row["categoria"];
					$nome = $row["nome"];
					$series = $row["series"];
					$repeticao = $row["repeticao"];
					$tempo = $row["tempo"];
					$imagem = $row["imagem"];
					$orientacao = $row['orientacao'];

					// Exibe o formulário de edição preenchido com os dados atuais do exercício
					echo '
            <form method="POST" action="" enctype="multipart/form-data">
						<h1>Editar exercício:</h1>
                <label for="categoria">Categoria:</label>
                <input type="text" name="categoria" id="categoria" value="' . $categoria . '"><br>
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" value="' . $nome . '"><br>
                <label for="series">Séries:</label>
                <input type="text" name="series" id="series" value="' . $series . '"><br>
                <label for="repeticao">Repetição:</label>
                <input type="text" name="repeticao" id="repeticao" value="' . $repeticao . '"><br>
                <label for="tempo">Tempo:</label>
                <input type="text" name="tempo" id="tempo" value="' . $tempo . '"><br>
								<label for="orientacao">Orientação:</label>
    						<textarea name="orientacao" id="orientacao">' . $orientacao . '</textarea><br>
                <label for="imagem">Imagem:</label>
                <input type="file" name="imagem" id="imagem"><br>
                <input type="submit" value="Salvar">
								<a class= "voltar" href="gerenciamento.php">voltar</a>
            </form>
            ';
				} else {
					echo "Exercício não encontrado.";
				}

				// Fecha a conexão com o banco de dados
				mysqli_close($conn);
			}
		} else {
			echo "ID do exercício inválido.";
		}
		?>
	</div>
</body>

</html>