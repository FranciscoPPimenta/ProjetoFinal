<?php
require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Access the form data
    $nome = $_POST["nome"];
    $desc = $_POST["descricao"];
    $animacao = $_POST["animacao"];
    $docentes = $_POST["docentes_selected"];
    $curso = $_POST["curso"];

    $sql = "SELECT * FROM ucs WHERE nome = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $nome);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            mysqli_stmt_close($stmtInsert);
            $sql = 'SELECT * FROM uc_curso WHERE id_curso =?';
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $curso);
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) > 0) {
                    $_SESSION["exists"] = "Já existe uma unidade nesse curso com o mesmo nome!";
                    $_SESSION["color"] = "danger";
                    header('Location: ../../admin/ucs/create.php');
                } else {
                    $sqlInsert = "INSERT INTO ucs (nome,descricao,id_animacao) VALUES (?,?,?)";
                    $stmtInsert = mysqli_prepare($conn, $sqlInsert);

                    if ($stmtInsert) {
                        // Bind parameters
                        mysqli_stmt_bind_param($stmtInsert, "ssi", $nome, $desc, $animacao);
                        // Execute the statement
                        $resultInsert = mysqli_stmt_execute($stmtInsert);
                        if ($resultInsert) {
                            $last_id = mysqli_insert_id($conn);
                            mysqli_stmt_close($stmtInsert);
                            $sqlInsert = "INSERT INTO escola_evento (id_evento,id_escola) VALUES (?,?)";
                            $stmtInsert = mysqli_prepare($conn, $sqlInsert);

                            if ($stmtInsert) {
                                // Bind parameters
                                mysqli_stmt_bind_param($stmtInsert, "ii", $last_id, $escola);
                                // Execute the statement
                                $resultInsert = mysqli_stmt_execute($stmtInsert);
                                if ($resultInsert) {
                                    $_SESSION["exists"] = "Evento " . $nome . " criado com sucesso!";
                                    $_SESSION["color"] = "success";
                                    header('Location: ../../admin/eventos/index.php');
                                }
                                // Close the statement
                                mysqli_stmt_close($stmtInsert);
                            }
                        }
                        if ($resultInsert) {
                            $_SESSION["exists"] = "Evento " . $nome . " criado com sucesso!";
                            $_SESSION["color"] = "success";
                            header('Location: ../../admin/eventos/index.php');
                        }
                        // Close the statement
                    }
                    // Close the statement
                    mysqli_stmt_close($stmt);
                }
            }
        } else {
            $sqlInsert = "INSERT INTO eventos (nome,descricao,id_animacao,id_ambito,dia,mes) VALUES (?,?,?,?,?,?)";
            $stmtInsert = mysqli_prepare($conn, $sqlInsert);

            if ($stmtInsert) {
                // Bind parameters
                mysqli_stmt_bind_param($stmtInsert, "ssiiii", $nome, $desc, $animacao, $ambito, $dia, $mes);
                // Execute the statement
                $resultInsert = mysqli_stmt_execute($stmtInsert);
                if ($resultInsert) {
                    $last_id = mysqli_insert_id($conn);
                    mysqli_stmt_close($stmtInsert);
                    $sqlInsert = "INSERT INTO escola_evento (id_evento,id_escola) VALUES (?,?)";
                    $stmtInsert = mysqli_prepare($conn, $sqlInsert);

                    if ($stmtInsert) {
                        // Bind parameters
                        mysqli_stmt_bind_param($stmtInsert, "ii", $last_id, $escola);
                        // Execute the statement
                        $resultInsert = mysqli_stmt_execute($stmtInsert);
                        if ($resultInsert) {
                            $_SESSION["exists"] = "Evento " . $nome . " criado com sucesso!";
                            $_SESSION["color"] = "success";
                            header('Location: ../../admin/eventos/index.php');
                        }
                        // Close the statement
                        mysqli_stmt_close($stmtInsert);
                    }
                }
                if ($resultInsert) {
                    $_SESSION["exists"] = "Evento " . $nome . " criado com sucesso!";
                    $_SESSION["color"] = "success";
                    header('Location: ../../admin/eventos/index.php');
                }
                // Close the statement
            }
            // Close the statement
            mysqli_stmt_close($stmt);
        }
    } else {
        // Handle the case where the form was not submitted
        echo "Please submit the form.";
    }
}
mysqli_close($conn);
