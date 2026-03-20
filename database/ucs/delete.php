<?php
require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare the SQL query with a parameterized statement
    $sql = "SELECT * FROM ucs WHERE id_uc = ?";
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

    $sql = "DELETE FROM uc_curso WHERE id_uc = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        echo 'nigga3';
        echo $id;
        // Bind the 'id' parameter to the prepared statement

        mysqli_stmt_bind_param($stmt, "i", $id);

        // Execute the query
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);
        echo mysqli_stmt_affected_rows($stmt);
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo 'nigga1';
            mysqli_stmt_close($stmt);
            $sql = "DELETE FROM uc_docente WHERE id_uc = ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                // Bind the 'id' parameter to the prepared statement

                mysqli_stmt_bind_param($stmt, "i", $id);

                // Execute the query
                mysqli_stmt_execute($stmt);

                // Get the result
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    echo 'nigga2';
                    mysqli_stmt_close($stmt);
                    $sql = "DELETE FROM ucs WHERE id_uc = ?";
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
                        header("Location: ../../admin/ucs/index.php");
                    }
                }

                mysqli_stmt_close($stmt);
                header("Location: ../../admin/ucs/index.php");
            }
        }
    } else {
        // Handle SQL preparation error
        echo json_encode(array("error" => "Failed to prepare SQL statement."));
    }
} else {
    // Handle missing 'id' parameter
    echo json_encode(array("error" => "No 'id' parameter provided."));
}
mysqli_close($conn);