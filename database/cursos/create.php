<?php
require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Access the form data
    $nome = $_POST["nome"];
    $desc = $_POST["descricao"];
    $regime = $_POST["regime"];
    $coordenador = $_POST["coordenador"];
    $escola = $_POST["escola"];
    $evento = $_POST["eventos"];
    $animacao = $_POST["animacao"];
    //Prepare the SQL statement

    $sql = "SELECT * FROM cursos WHERE nome = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $nome);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION["exists"] = "Já existe um curso com esse nome!";
            $_SESSION["color"] = "danger";
            header('Location: ../../admin/cursos/create.php');
        } else {
            $sqlInsert = "INSERT INTO cursos (nome,descricao,id_escola,regime,id_coordenador,id_evento,id_animacao) VALUES (?,?,?,?,?,?,?)";
            $stmtInsert = mysqli_prepare($conn, $sqlInsert);

            if ($stmtInsert) {
                // Bind parameters
                mysqli_stmt_bind_param($stmtInsert, "ssisiii", $nome, $desc, $escola, $regime, $coordenador, $evento, $animacao);
                // Execute the statement
                $resultInsert = mysqli_stmt_execute($stmtInsert);
                if ($resultInsert) {
                    $_SESSION["exists"] = "Curso " . $nome . " criada com sucesso!";
                    $_SESSION["color"] = "success";
                    header('Location: ../../admin/cursos/index.php');
                }
                // Close the statement
                mysqli_stmt_close($stmt);
            } else {
                echo json_encode(array("error" => "Failed to prepare SQL statement."));
            }
        }
    }
} else {
    // Handle the case where the form was not submitted
    echo "Please submit the form.";
}
mysqli_close($conn);
