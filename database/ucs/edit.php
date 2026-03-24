<?php
require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Access the form data
        $sql = "SELECT * FROM ucs WHERE nome = ? AND id_curso != ? AND id_uc != ?";
        $stmt = mysqli_prepare($conn, $sql);
        $nome = $_POST["nome"];
        $curso = $_POST["curso"];
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sii", $nome, $curso, $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                mysqli_stmt_close($stmt);
                $_SESSION["exists"] = "Já existe uma unidade curricular com esse nome no curso escolhido!";
                $_SESSION["color"] = "danger";
                header('Location: ../../admin/eventos/edit.php?id=' . $_SESSION["ucs"]["id_uc"]);
                mysqli_stmt_close($stmt);
            } else {
                $nome = $_POST["nome"];
                $desc = $_POST["descricao"];
                $animacao = $_POST["animacao"];
                $docentes = $_POST["docentes_selected"];
                //Prepare the SQL statement
                $newDocentes = json_decode($docentes);
                $newDocentes = array_map('intval', $newDocentes);
                if (count($newDocentes) !== count(array_unique($newDocentes))) {
                    $_SESSION["exists"] = "Não pode adicionar o mesmo docente mais que uma vez!";
                    $_SESSION["color"] = "danger";
                    header('Location: ../../admin/ucs/create.php');
                } else {
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
                            mysqli_stmt_close($stmt);
                        }
                        $sql = "UPDATE ucs SET nome = ? , descricao = ?, id_animacao = ?, id_curso = ? WHERE id_uc = ?";
                        $stmt = mysqli_prepare($conn, $sql);
                        if ($stmt) {
                            // Bind parameters
                            mysqli_stmt_bind_param($stmt, "ssiii", $nome, $descricao, $animacao, $curso, $id);
                            // Execute the statement
                            mysqli_stmt_execute($stmt);
                            if (mysqli_stmt_affected_rows($stmt) > 0) {
                                mysqli_stmt_close($stmt);
                                foreach ($newDocentes as $docente) {
                                    $sqlInsert = "INSERT INTO uc_docente (id_uc,id_docente) VALUES (?,?)";
                                    $stmtInsert = mysqli_prepare($conn, $sqlInsert);
                                    if ($stmtInsert) {
                                        mysqli_stmt_bind_param($stmtInsert, 'ii', $id, $docente);
                                        $resultInsert = mysqli_stmt_execute($stmtInsert);
                                        if ($resultInsert) {
                                            $_SESSION["updated"] = "Unidade Curricular " . $nome . " atualizado com sucesso!";
                                            $_SESSION["color"] = "success";
                                            header('Location: ../../admin/ucs/edit.php');
                                        }
                                        mysqli_stmt_close($stmtInsert);
                                    }
                                }
                            }
                            header('Location: ../../admin/ucs/edit.php?id=' . $_SESSION["uc"]["id_uc"]);
                            // Close the statement
                            mysqli_stmt_close($stmt);
                        } else {
                            echo json_encode(array("error" => "Failed to prepare SQL statement."));
                        }
                    }
                }
            }
        }
    } else {
        // Handle the case where the form was not submitted
        echo "Please submit the form.";
    }
    // Prepare the SQL query with a parameterized statement
    $sql = "SELECT eventos.*,animacoes.nome as 'Animacao',animacoes.textura as 'Textura',animacoes.objeto as 'Objeto', ambitos.nome as 'Ambito' FROM eventos INNER JOIN animacoes ON eventos.id_animacao = animacoes.id_animacao INNER JOIN ambitos ON eventos.id_ambito = ambitos.id_ambito WHERE id_evento = ?";
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
            $_SESSION["evento"] = $row;
        }
        //header('Location: ../../admin/eventos/edit.php?id='.$_SESSION["evento"]["id_evento"]);
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle SQL preparation error
        echo json_encode(array("error" => "Failed to prepare SQL statement."));
    }
} else {
    // Handle missing 'id' parameter
    echo json_encode(array("error" => "No 'id' parameter provided."));
}
mysqli_close($conn);