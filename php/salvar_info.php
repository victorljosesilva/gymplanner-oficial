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
} else {
  header("Location: ../");
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nome = $_POST["nome"];
  $email = $_POST["email"];
  $nascimento = $_POST["nascimento"];
  $sexo = $_POST["sexo"];

  $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', nascimento = '$nascimento', sexo = '$sexo' WHERE email = '$email'";

  if (mysqli_query($conexao, $sql)) {
    header("Location: perfil_usuario.php");
    exit();
  } else {
    echo "Erro ao atualizar informações: " . mysqli_error($conexao);
  }
}

mysqli_close($conexao);
