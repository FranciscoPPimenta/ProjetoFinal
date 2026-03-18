<?php
require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Access the form data
    $dataInteira = new DateTime($_POST["data"]);
    $nome = $_POST["nome"];
    $desc = $_POST["descricao"];
    $animacao = $_POST["animacao"];
    $ambito = $_POST["ambito"];
    $escola = $_POST["escolas"];
    if ($dataInteira->format('d') < 10) {
        $dia = substr($dataInteira->format('d'), 1, 1);
    } else {
        $dia = $dataInteira->format('d');
    }

    if ($dataInteira->format('m') < 10) {
        $mes = substr($dataInteira->format('m'), 1, 1);
    } else {
        $mes = $dataInteira->format('m');
    }
    $sql = "SELECT * FROM eventos WHERE nome = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $nome);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["exists"] = "Já existe um evento com esse nome!";
            $_SESSION["color"] = "danger";
            header('Location: ../../admin/eventos/create.php');
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