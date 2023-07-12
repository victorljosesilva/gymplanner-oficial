<?php
$servidor = "localhost";
$usuario = "root";
$senha = "#userVL2023";
$banco = "gymplanner2";

$conn = mysqli_connect($servidor, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if (isset($_POST['id'])) {
    $exercicioId = $_POST['id'];

    $sql = "DELETE FROM exercicios_usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $exercicioId);
    $stmt->execute();

    if ($stmt->error) {
        echo "Falha ao excluir o exercício: " . $stmt->error;
    } else {
        if ($stmt->affected_rows > 0) {
            echo "Exercício excluído com sucesso.";
        }
    }
    $stmt->close();
}

$conn->close();
