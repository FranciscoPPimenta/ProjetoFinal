<?php
require_once '../config.php';
session_start();

// Check if the 'id' parameter is provided in the request
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if the 'id' parameter is provided in the request
        echo $_FILES['objeto']['tmp_name'] . "iiiiiiiiiiiii" . $_FILES['textura']['tmp_name'];
        if (($_FILES['textura']['tmp_name']) != "" && ($_FILES['objeto']['tmp_name']) != "") {
            $nome = $_POST["nome"];
            $sql = "SELECT * FROM animacoes WHERE nome = ? AND id_animacao != ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                // Bind parameters
                mysqli_stmt_bind_param($stmt, 'si', $nome, $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) > 0) {
                    $_SESSION["exists"] = "Já existe uma animação com o mesmo nome!";
                    $_SESSION["color"] = "danger";
                    header('Location: ../../admin/animacoes/edit.php?id=' . $_SESSION["animacao"]["id_animacao"]);
                } else {
                    $texture = file_get_contents($_FILES['textura']['tmp_name']);
                    $objeto = file_get_contents($_FILES['objeto']['tmp_name']);
                    $sqlInsert = "UPDATE animacoes SET nome = ?, textura = ?, objeto = ? WHERE id_animacao = ?";
                    $stmtInsert = mysqli_prepare($conn, $sqlInsert);

                    if ($stmtInsert) {
                        // Bind parameters
                        mysqli_stmt_bind_param($stmtInsert, 'sbbi', $nome, $null, $null, $id);

                        $null = NULL;
                        mysqli_stmt_send_long_data($stmtInsert, 1, $texture);
                        mysqli_stmt_send_long_data($stmtInsert, 2, $objeto);
                        $resultInsert = mysqli_stmt_execute($stmtInsert);
                        if ($resultInsert) {
                            $_SESSION["updated"] = "Animação " . $nome . " atualizada com sucesso!";
                            $_SESSION["color"] = "success";
                            header(header: 'Location: ../../admin/animacoes/edit.php?id=' . $_SESSION["animacao"]["id_animacao"]);
                        }
                        // Close the statement
                        mysqli_stmt_close($stmtInsert);
                    } else {
                        echo json_encode(array("error" => "Failed to prepare SQL statement."));
                    }
                }
                // Close the first statement before executing the second query
                mysqli_stmt_close($stmt);
            } else {
                echo json_encode(array("error" => "Failed to prepare SQL statement."));
            }

            // Second SELECT Query
            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $id);
                // Execute the query
                mysqli_stmt_execute($stmt);

                // Get the result
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION["animacao"] = $row;
                } else {
                    echo "No records found."; // Handle case where no records are found
                }
                echo $_SESSION["updated"];
                // Close the second statement
                mysqli_stmt_close($stmt);
            }
        } else if (($_FILES['textura']['tmp_name']) != "") {
            echo 'rawr';
            $nome = $_POST["nome"];
            $sql = "SELECT * FROM animacoes WHERE nome = ? AND id_animacao != ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                // Bind parameters
                mysqli_stmt_bind_param($stmt, 'si', $nome, $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) > 0) {
                    $_SESSION["exists"] = "Já existe uma animação com o mesmo nome!";
                    $_SESSION["color"] = "danger";
                    header('Location: ../../admin/animacoes/edit.php?id=' . $_SESSION["animacao"]["id_animacao"]);
                } else {
                    $texture = file_get_contents($_FILES['textura']['tmp_name']);

                    $sqlInsert = "UPDATE animacoes SET nome = ?, textura = ? WHERE id_animacao = ?";
                    $stmtInsert = mysqli_prepare($conn, $sqlInsert);

                    if ($stmtInsert) {
                        // Bind parameters
                        mysqli_stmt_bind_param($stmtInsert, 'sbi', $nome, $null, $id);

                        $null = NULL;
                        mysqli_stmt_send_long_data($stmtInsert, 1, $texture);
                        $resultInsert = mysqli_stmt_execute($stmtInsert);
                        if ($resultInsert) {
                            $_SESSION["updated"] = "Animação " . $nome . " atualizada com sucesso!";
                            $_SESSION["color"] = "success";
                        }
                        // Close the statement
                        mysqli_stmt_close($stmtInsert);
                    } else {
                        echo json_encode(array("error" => "Failed to prepare SQL statement."));
                    }
                    header('Location: ../../admin/animacoes/edit.php?id=' . $_SESSION["animacao"]["id_animacao"]);
                }
                // Close the first statement before executing the second query
                mysqli_stmt_close($stmt);
            } else {
                echo json_encode(array("error" => "Failed to prepare SQL statement."));
            }

            // Second SELECT Query
            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $id);
                // Execute the query
                mysqli_stmt_execute($stmt);

                // Get the result
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION["animacao"] = $row;
                } else {
                    echo "No records found."; // Handle case where no records are found
                }
                echo $_SESSION["updated"];
                // Close the second statement
                mysqli_stmt_close($stmt);
            }
        } else if (($_FILES['objeto']['tmp_name']) != "") {
            $nome = $_POST["nome"];
            $sql = "SELECT * FROM animacoes WHERE nome = ? AND id_animacao != ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                // Bind parameters
                mysqli_stmt_bind_param($stmt, 'si', $nome, $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) > 0) {
                    $_SESSION["exists"] = "Já existe uma animação com o mesmo nome!";
                    $_SESSION["color"] = "danger";
                    header('Location: ../../admin/animacoes/edit.php?id=' . $_SESSION["animacao"]["id_animacao"]);
                } else {
                    $objeto = file_get_contents($_FILES['objeto']['tmp_name']);
                    $sqlInsert = "UPDATE animacoes SET nome = ?, objeto = ? WHERE id_animacao = ?";
                    $stmtInsert = mysqli_prepare($conn, $sqlInsert);

                    if ($stmtInsert) {
                        // Bind parameters
                        mysqli_stmt_bind_param($stmtInsert, 'sbi', $nome, $null, $id);

                        $null = NULL;
                        mysqli_stmt_send_long_data($stmtInsert, 1, $objeto);
                        $resultInsert = mysqli_stmt_execute($stmtInsert);
                        if ($resultInsert) {
                            $_SESSION["updated"] = "Animação " . $nome . " atualizada com sucesso!";
                            $_SESSION["color"] = "success";
                        }
                        // Close the statement
                        mysqli_stmt_close($stmtInsert);
                    } else {
                        echo json_encode(array("error" => "Failed to prepare SQL statement."));
                    }
                    header('Location: ../../admin/animacoes/edit.php?id=' . $_SESSION["animacao"]["id_animacao"]);
                }
                // Close the first statement before executing the second query
                mysqli_stmt_close($stmt);
            } else {
                echo json_encode(array("error" => "Failed to prepare SQL statement."));
            }

            // Second SELECT Query
            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $id);
                // Execute the query
                mysqli_stmt_execute($stmt);

                // Get the result
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION["animacao"] = $row;
                } else {
                    echo "No records found."; // Handle case where no records are found
                }
                echo $_SESSION["updated"];
                // Close the second statement
                mysqli_stmt_close($stmt);
            }
        } else {
            $nome = $_POST["nome"];
            $sql = "SELECT * FROM animacoes WHERE nome = ? AND id_animacao != ?";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                // Bind parameters
                mysqli_stmt_bind_param($stmt, 'si', $nome, $id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) > 0) {
                    $_SESSION["exists"] = "Já existe uma animação com o mesmo nome!";
                    $_SESSION["color"] = "danger";
                    header('Location: ../../admin/animacoes/edit.php?id=' . $_SESSION["animacao"]["id_animacao"]);
                } else {
                    $sqlInsert = "UPDATE animacoes SET nome = ? WHERE id_animacao = ?";
                    $stmtInsert = mysqli_prepare($conn, $sqlInsert);

                    if ($stmtInsert) {
                        // Bind parameters
                        mysqli_stmt_bind_param($stmtInsert, 'si', $nome, $id);

                        $resultInsert = mysqli_stmt_execute($stmtInsert);
                        if ($resultInsert) {
                            $_SESSION["updated"] = "Animação " . $nome . " atualizada com sucesso!";
                            $_SESSION["color"] = "success";
                        }
                        // Close the statement
                        mysqli_stmt_close($stmtInsert);
                    } else {
                        echo json_encode(array("error" => "Failed to prepare SQL statement."));
                    }
                    header('Location: ../../admin/animacoes/edit.php?id=' . $_SESSION["animacao"]["id_animacao"]);
                }
                // Close the statement
                mysqli_stmt_close($stmt);
            } else {
                echo json_encode(array("error" => "Failed to prepare SQL statement."));
            }

            // Second SELECT Query
            $sql = "SELECT * FROM animacoes WHERE id_animacao = ?";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $id);
                // Execute the query
                mysqli_stmt_execute($stmt);

                // Get the result
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION["animacao"] = $row;
                } else {
                    echo "No records found."; // Handle case where no records are found
                }
                //header('Location: ../../admin/animacoes/edit.php?id=' . $_SESSION["animacao"]["id_animacao"]);

                // Close the statement
                mysqli_stmt_close($stmt);
            }
        }
    }
} else {
    // Handle missing 'id' parameter
    echo json_encode(array("error" => "No 'id' parameter provided."));
}

mysqli_close($conn);
