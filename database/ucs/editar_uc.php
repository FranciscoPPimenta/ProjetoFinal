<?php

use Dom\Mysql;

require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL query with a parameterized statement
    $sql = "SELECT ucs.*,animacoes.nome as 'Animacao',animacoes.textura as 'Textura', cursos.nome as 'Curso',animacoes.objeto as 'Objeto' FROM ucs INNER JOIN animacoes ON ucs.id_animacao = animacoes.id_animacao INNER JOIN cursos ON ucs.id_curso = cursos.id_curso WHERE id_uc = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the 'id' parameter to the prepared statement

        mysqli_stmt_bind_param($stmt, "i", $id);

        // Execute the query
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION["uc"] = $row;
        }
        mysqli_stmt_close($stmt);
        $sql = "SELECT COUNT(*) FROM uc_docente WHERE id_uc = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                mysqli_stmt_close($stmt);
                $sql = "SELECT * FROM docentes INNER JOIN uc_docente ON docentes.id_docente = uc_docente.id_docente WHERE id_uc = ?";
                $stmt = mysqli_prepare($conn, $sql);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'i', $id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $nomes[] = $row;
                    }
                    $_SESSION['nome_docentes'] = $nomes;
                    header('Location: ../../admin/ucs/edit.php?id=' . $_SESSION["uc"]["id_uc"]);
                    // Close the statement
                    mysqli_stmt_close($stmt);
                }
            }
        }
        // Close the statement

    } else {
        // Handle SQL preparation error
        echo json_encode(array("error" => "Failed to prepare SQL statement."));
    }
} else {
    // Handle missing 'id' parameter
    echo json_encode(array("error" => "No 'id' parameter provided."));
}
mysqli_close($conn);