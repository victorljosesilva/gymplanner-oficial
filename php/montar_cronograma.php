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
$consulta = "SELECT id FROM usuarios WHERE email = '$email'";
$resultado = mysqli_query($conexao, $consulta);
if (mysqli_num_rows($resultado) == 1) {
    $usuario = mysqli_fetch_assoc($resultado);
    $idUsuario = $usuario["id"];
}
$consultaUsuario = "SELECT foto_perfil FROM usuarios WHERE email = '$email'";
$resultadoUsuario = mysqli_query($conexao, $consultaUsuario);
if (mysqli_num_rows($resultadoUsuario) == 1) {
    $usuario = mysqli_fetch_assoc($resultadoUsuario);
    $foto_perfil = $usuario['foto_perfil'];
}
$consultaCategorias = "SELECT DISTINCT categoria FROM exercicios";
$resultadoCategorias = mysqli_query($conexao, $consultaCategorias);
$exercicios = array();
while ($linhaCategoria = mysqli_fetch_assoc($resultadoCategorias)) {
    $categoria = $linhaCategoria["categoria"];
    $consultaExercicios = "SELECT nome, series, repeticao, tempo FROM exercicios WHERE categoria = '$categoria'";
    $resultadoExercicios = mysqli_query($conexao, $consultaExercicios);
    $exercicios[$categoria] = array();
    while ($linhaExercicio = mysqli_fetch_assoc($resultadoExercicios)) {
        $exercicio = array(
            "nome" => $linhaExercicio["nome"],
            "series" => $linhaExercicio["series"],
            "repeticao" => $linhaExercicio["repeticao"],
            "tempo" => $linhaExercicio["tempo"]
        );
        array_push($exercicios[$categoria], $exercicio);
    }
}
$consultaExerciciosUsuario = "SELECT id, categoria, nome, series, repeticao, tempo FROM exercicios_usuarios WHERE usuario_id = '$idUsuario'";

$resultadoExerciciosUsuario = mysqli_query($conexao, $consultaExerciciosUsuario);
mysqli_close($conexao);
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["categoria"]) && isset($_POST["exercicio"]) && isset($_POST["series"]) && isset($_POST["repeticoes"]) && isset($_POST["tempo"])) {
    $categoria = $_POST["categoria"];
    $exercicioIndex = $_POST["exercicio"];
    $series = $_POST["series"];
    $repeticoes = $_POST["repeticoes"];
    $tempo = $_POST["tempo"];
    $exercicios = $exercicios[$categoria];
    $exercicio = $exercicios[$exercicioIndex];
    if ($exercicio) {

        $categoriaExercicio = $categoria;
        $nomeExercicio = $exercicio["nome"];
        $servidor = "localhost";
        $usuario = "root";
        $senha = "#userVL2023";
        $banco = "gymplanner2";

        $conexao = mysqli_connect($servidor, $usuario, $senha, $banco);
        if (!$conexao) {
            die("Falha na conexão: " . mysqli_connect_error());
        }
        $inserirExercicioUsuario = "INSERT INTO exercicios_usuarios (categoria, nome, series, repeticao, tempo, usuario_id)
                                            VALUES ('$categoriaExercicio', '$nomeExercicio', '$series', '$repeticoes', '$tempo', '$idUsuario')";
        mysqli_query($conexao, $inserirExercicioUsuario);
        mysqli_close($conexao);

        // Redirecionar para a mesma página
        header("Location: " . $_SERVER["PHP_SELF"]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cronograma</title>
    <link rel="stylesheet" href="/css/montar_cronograma.css">
    <link rel="stylesheet" href="/css/menu_navegacao.css">
</head>

<body>
    <nav class="nav-bar">
        <a class="menu-inicial" href="tela_inicial.php">Início</a>
        <a href="ver_exercicios.php">Exercícios</a>
        <a href="calcular_imc.php">IMC</a>
        <a href="saiba_mais.php">Saiba Mais</a>
        <a href="conhecimento.php">Sobre</a>
        <a href="/php/perfil_usuario.php"><img src="<?php echo $foto_perfil; ?>" alt="Foto de Perfil"></a>
    </nav>
    <main>
        <div class="grid">
            <table>
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Nome</th>
                        <th>Séries</th>
                        <th>Repetições</th>
                        <th>Tempo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($exercicioUsuario = mysqli_fetch_assoc($resultadoExerciciosUsuario)) {
                        echo "<tr>";
                        echo "<td>" . $exercicioUsuario["categoria"] . "</td>";
                        echo "<td>" . $exercicioUsuario["nome"] . "</td>";
                        echo "<td>" . $exercicioUsuario["series"] . "</td>";
                        echo "<td>" . $exercicioUsuario["repeticao"] . "</td>";
                        echo "<td>" . $exercicioUsuario["tempo"] . "</td>";
                        echo "<td>";
                        echo "<button onclick='editarExercicio(" . $exercicioUsuario["id"] . ")'>Editar</button>";
                        echo "<button onclick='excluirExercicio(" . $exercicioUsuario["id"] . ")'>Excluir</button>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div>
                <form method="post" action="montar_cronograma.php">
                    <label for="categoria">Categoria:</label>
                    <select name="categoria" id="categoria" onchange="carregarExercicios()">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($exercicios as $categoria => $exerciciosCategoria) {
                            echo "<option value='$categoria'>$categoria</option>";
                        }
                        ?>
                    </select>
                    <label for="exercicio">Exercício:</label>
                    <select name="exercicio" id="exercicio" onchange="preencherValores()">
                    </select>
                    <label for="series">Séries:</label>
                    <input type="number" name="series" id="series">
                    <label for="repeticoes">Repetições:</label>
                    <input type="number" name="repeticoes" id="repeticoes">
                    <label for="tempo">Tempo:</label>
                    <input type="number" name="tempo" id="tempo">
                    <input type="submit" value="Enviar">
                </form>
            </div>
            <script>
                var exerciciosData = <?php echo json_encode($exercicios); ?>;

                function carregarExercicios() {
                    var categoria = document.getElementById("categoria").value;
                    var selectExercicio = document.getElementById("exercicio");
                    selectExercicio.innerHTML = "";
                    var exercicios = exerciciosData[categoria];
                    for (var i = 0; i < exercicios.length; i++) {
                        var option = document.createElement("option");
                        option.value = i;
                        option.text = exercicios[i].nome;
                        selectExercicio.appendChild(option);
                    }
                    preencherValores();
                }

                function preencherValores() {
                    var categoria = document.getElementById("categoria").value;
                    var exercicioIndex = document.getElementById("exercicio").value;
                    var seriesInput = document.getElementById("series");
                    var repeticoesInput = document.getElementById("repeticoes");
                    var tempoInput = document.getElementById("tempo");
                    var exercicios = exerciciosData[categoria];
                    var exercicio = exercicios[exercicioIndex];
                    if (exercicio) {
                        seriesInput.value = exercicio.series;
                        repeticoesInput.value = exercicio.repeticao;
                        tempoInput.value = exercicio.tempo;
                    } else {
                        seriesInput.value = "";
                        repeticoesInput.value = "";
                        tempoInput.value = "";
                    }
                }

                function excluirExercicio(id) {
                    window.location.href = "excluir_exercicio.php?id=" + id;

                }

                function editarExercicio(id) {
                    if (confirm("Tem certeza que deseja editar  este exercício?")) {
                        window.location.href = "editar_exercicio.php?id=" + id;
                    }
                }
            </script>
        </div>

    </main>

</body>

</html>