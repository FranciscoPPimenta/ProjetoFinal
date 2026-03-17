<?php
require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sqlCheck = "SELECT COUNT(*) FROM cursos WHERE id_evento = ?";
    $stmtCheck = mysqli_prepare($conn, $sqlCheck);

    if (!$stmtCheck) {
        echo "Error preparing the check query: " . mysqli_error($conn);
    }

    // Bind the parameter (evento ID)
    mysqli_stmt_bind_param($stmtCheck, "i", $id);

    // Execute the query
    mysqli_stmt_execute($stmtCheck);
    mysqli_stmt_bind_result($stmtCheck, $count);

    // Fetch the result
    mysqli_stmt_fetch($stmtCheck);

    // Close the statement
    mysqli_stmt_close($stmtCheck);

    // Step 2: If there are references, block deletion
    if ($count > 0) {
        $_SESSION["exists"] = "A tabela Cursos tem uma ligação com o evento que deseja apagar.";
        if ($page == "index") {
            //header("Location: ../../admin/eventos/index.php");
        } else {
            //header("Location: ../../admin/eventos/edit.php?id=" . $id);
        }
    }


    // Prepare the SQL query with a parameterized statement
    $sql = "SELECT * FROM eventos WHERE id_evento = ?";
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
            $deleted = $row["nome"];
            echo $deleted;
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle SQL preparation error
        echo json_encode(array("error" => "Failed to prepare SQL statement."));
    }
    $sql = "DELETE FROM eventos WHERE id_evento = ?";
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
        //header("Location: ../../admin/eventos/index.php");
    } else {
        // Handle SQL preparation error
        echo json_encode(array("error" => "Failed to prepare SQL statement."));
    }
} else {
    // Handle missing 'id' parameter
    echo json_encode(array("error" => "No 'id' parameter provided."));
}
mysqli_close($conn);
