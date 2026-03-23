<?php

use function PHPSTORM_META\type;

require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Access the form data
    $nome = $_POST["nome"];
    $desc = $_POST["descricao"];
    $animacao = $_POST["animacao"];
    $docentes = $_POST["docentes_selected"];
    $curso = $_POST["curso_curso"];
    $sql = "SELECT * FROM ucs WHERE nome = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $nome);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            mysqli_stmt_close($stmt);
            $sql = 'SELECT * FROM ucs WHERE id_curso =?';
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "i", $curso);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($result) > 0) {
                    $_SESSION["exists"] = "Já existe uma unidade nesse curso com o mesmo nome!";
                    $_SESSION["color"] = "danger";
                    header('Location: ../../admin/ucs/create.php');
                } else {
                    $newDocentes = json_decode($docentes);
                    $newDocentes = array_map('intval', $newDocentes);
                    mysqli_stmt_close($stmt);
                    if (count($newDocentes) !== count(array_unique($newDocentes))) {
                        $_SESSION["exists"] = "Não pode adicionar o mesmo docente mais que uma vez!";
                        $_SESSION["color"] = "danger";
                        header('Location: ../../admin/ucs/create.php');
                    } else {
                        foreach ($newDocentes as $docente) {
                            $sqlInsert = "INSERT INTO ucs (nome,descricao,id_animacao,id_curso) VALUES (?,?,?,?)";
                            $stmtInsert = mysqli_prepare($conn, $sqlInsert);
                            if ($stmtInsert) {
                                // Bind parameters
                                mysqli_stmt_bind_param($stmtInsert, "ssii", $nome, $desc, $animacao, $curso);
                                // Execute the statement
                                $resultInsert = mysqli_stmt_execute($stmtInsert);
                                if ($resultInsert) {
                                    $last_id = mysqli_insert_id($conn);
                                    mysqli_stmt_close($stmtInsert);
                                    foreach ($newDocentes as $docente) {
                                        $sqlInsert = "INSERT INTO uc_docente (id_uc,id_docente) VALUES (?,?)";
                                        $stmtInsert = mysqli_prepare($conn, $sqlInsert);
                                        if ($stmtInsert) {
                                            mysqli_stmt_bind_param($stmtInsert, 'ii', $last_id, $docente);
                                            $resultInsert = mysqli_stmt_execute($stmtInsert);
                                            if ($resultInsert) {
                                                $_SESSION["exists"] = "Unidade Curricular " . $nome . " criada com sucesso!";
                                                $_SESSION["color"] = "success";
                                                header('Location: ../../admin/ucs/index.php');
                                            }
                                            mysqli_stmt_close($stmtInsert);
                                        }
                                    }
                                }
                            }
                            // Close the statement
                            mysqli_stmt_close($stmt);
                        }
                    }
                }
            }
        } else {
            $newDocentes = json_decode($docentes);
            $newDocentes = array_map('intval', $newDocentes);
            $sqlInsert = "INSERT INTO ucs (nome,descricao,id_animacao,id_curso) VALUES (?,?,?,?)";
            $stmtInsert = mysqli_prepare($conn, $sqlInsert);
            if (count($newDocentes) !== count(array_unique($newDocentes))) {
                $_SESSION["exists"] = "Não pode adicionar o mesmo docente mais que uma vez!";
                $_SESSION["color"] = "danger";
                header('Location: ../../admin/ucs/create.php');
            } else {
                if ($stmtInsert) {
                    // Bind parameters
                    mysqli_stmt_bind_param($stmtInsert, "ssii", $nome, $desc, $animacao, $curso);
                    // Execute the statement
                    $resultInsert = mysqli_stmt_execute($stmtInsert);
                    if ($resultInsert) {
                        $last_id = mysqli_insert_id($conn);
                        mysqli_stmt_close($stmtInsert);
                        var_dump($newDocentes);
                        foreach ($newDocentes as $docente) {
                            $sqlInsert = "INSERT INTO uc_docente (id_uc,id_docente) VALUES (?,?)";
                            $stmtInsert = mysqli_prepare($conn, $sqlInsert);
                            if ($stmtInsert) {
                                mysqli_stmt_bind_param($stmtInsert, 'ii', $last_id, $docente);
                                $resultInsert = mysqli_stmt_execute($stmtInsert);
                                if ($resultInsert) {
                                    $_SESSION["exists"] = "Unidade Curricular " . $nome . " criada com sucesso!";
                                    $_SESSION["color"] = "success";
                                    header('Location: ../../admin/ucs/index.php');
                                }
                                mysqli_stmt_close($stmtInsert);
                            }
                        }
                    }
                    // Close the statement
                }
                // Close the statement
                mysqli_stmt_close($stmt);
            }
        }
    } else {
        // Handle the case where the form was not submitted
        echo "Please submit the form.";
    }
}
mysqli_close($conn);