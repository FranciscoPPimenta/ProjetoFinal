<?php
require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $page = $_GET['start_page'];
    echo $page;

    $deleted_name = "SELECT nome FROM ambitos WHERE id_ambito = ?";

    $stmt = mysqli_prepare($conn, $deleted_name);

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $nome);

    if (mysqli_stmt_fetch($stmt)) {
        $deleted = $nome;
    }

    mysqli_stmt_close($stmt);

    $sqlCheck = "SELECT COUNT(*) FROM eventos WHERE id_ambito = ?";
    $stmtCheck = mysqli_prepare($conn, $sqlCheck);

    if (!$stmtCheck) {
        echo "Error preparing the check query: " . mysqli_error($conn);
    }

    mysqli_stmt_bind_param($stmtCheck, "i", $id);

    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_bind_result($stmtCheck, $count);

    mysqli_stmt_fetch($stmtCheck);

    mysqli_stmt_close($stmtCheck);

    if ($count > 0) {
        $_SESSION["exists"] = "Ainda existem cursos associados com este ,ambito. Não pode apagá-lo ainda!";
        $_SESSION["color"] = "danger";
        if ($page == "index") {
            header("Location: ../../admin/ambitos/index.php");
        } else {
            //header("Location: ../../admin/escolas/edit.php?id=" . $id);
        }
        exit();
    }


    $sql = "DELETE FROM ambitos WHERE id_ambito = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind the 'id' parameter to the prepared statement

        mysqli_stmt_bind_param($stmt, "i", $id);

        // Execute the query
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $_SESSION["deleted"] = "true";
            $_SESSION["deletedObject"] = $deleted;
        }
        mysqli_stmt_close($stmt);
        header("Location: ../../admin/ambitos/index.php");
    } else {
        // Handle SQL preparation error
        echo json_encode(array("error" => "Failed to prepare SQL statement."));
    }
}
