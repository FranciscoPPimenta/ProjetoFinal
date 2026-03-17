<?php
require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Access the form data
        $nome = $_POST["nome"];
        $descricao = $_POST["descricao"];
        $animacao = $_POST["animacao"];
        $regime = $_POST["regime"];
        $coordenador = $_POST["docente"];
        $escola = $_POST["escola"];
        $evento = $_POST["evento"];
        $sql = "SELECT * FROM eventos WHERE id_evento = ? ";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $evento);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $eventoUpdated = $row["id_evento"];
                mysqli_stmt_close($stmt);
            }
        }
        $sql = "SELECT * FROM escolas WHERE id_escola = ? ";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $escola);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $escolaUpdated = $row["id_escola"];
                mysqli_stmt_close($stmt);
            }
        }
        $sql = "SELECT * FROM cursos WHERE nome = ? AND id_curso != ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $nome, $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $_SESSION["exists"] = "Já existe um com esse nome!";
                $_SESSION["color"] = "danger";
                header('Location: ../../admin/cursos/edit.php?id=' . $_SESSION["curso"]["id_curso"]);
                mysqli_stmt_close($stmt);
            } else {
                mysqli_stmt_close($stmt);
                $sqlUpdate = "UPDATE cursos SET nome = ? , descricao = ?, id_animacao = ?, id_coordenador = ?, id_evento = ?,id_escola = ?,regime = ? WHERE id_curso = ?";
                $stmtUpdate = mysqli_prepare($conn, $sqlUpdate);

                if ($stmtUpdate) {
                    // Bind parameters
                    mysqli_stmt_bind_param($stmtUpdate, "ssiiiisi", $nome, $descricao, $animacao, $coordenador, $eventoUpdated, $escolaUpdated, $regime, $id);
                    // Execute the statement
                    mysqli_stmt_execute($stmtUpdate);
                    if (mysqli_stmt_affected_rows($stmtUpdate) > 0) {
                        $_SESSION["updated"] = "Curso " . $nome . " atualizado com sucesso!";
                    }
                    // Close the statement
                    mysqli_stmt_close($stmtUpdate);
                } else {
                    echo json_encode(array("error" => "Failed to prepare SQL statement."));
                }
            }
        }
        $sql = "SELECT cursos.*,animacoes.nome as 'Animacao',animacoes.textura as 'Textura',animacoes.objeto as 'Objeto', docentes.nome as 'Docente', escolas.nome as 'Escola', eventos.nome as 'Evento' FROM cursos INNER JOIN animacoes ON cursos.id_animacao = animacoes.id_animacao  INNER JOIN docentes ON cursos.id_coordenador = docentes.id_docente INNER JOIN escolas ON cursos.id_escola = escolas.id_escola INNER JOIN eventos ON cursos.id_evento = eventos.id_evento WHERE id_curso = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "i", $id);
            // Execute the query
            mysqli_stmt_execute($stmt);

            // Get the result
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION["curso"] = $row;
            } else {
                echo "No records found."; // Handle case where no records are found
            }
            header('Location: ../../admin/cursos/edit.php?id=' . $_SESSION["curso"]["id_curso"]);
            // Close the statement
            mysqli_stmt_close($stmt);
        }
    } else {
        // Handle missing 'id' parameter
        echo json_encode(array("error" => "No 'id' parameter provided."));
    }
}
mysqli_close($conn);
