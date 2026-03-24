<?php
require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Access the form data
        $sql = "SELECT * FROM eventos WHERE nome = ? AND id_evento != ?";
        $stmt = mysqli_prepare($conn, $sql);
        $nome = $_POST["nome"];
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $nome, $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $_SESSION["exists"] = "Já existe um evento com esse nome!";
                $_SESSION["color"] = "danger";
                header('Location: ../../admin/eventos/edit.php?id=' . $_SESSION["evento"]["id_evento"]);
                mysqli_stmt_close($stmt);
            } else {
                $dataInteira = new DateTime($_POST["data"]);
                $descricao = $_POST["descricao"];
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
                $ambito = $_POST["ambito"];
                $animacao = $_POST["animacao"];
                //Prepare the SQL statement
                $sql = "UPDATE eventos SET nome = ? , descricao = ?, dia = ?, mes = ? , id_ambito = ?, id_animacao = ? WHERE id_evento = ?";
                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt) {
                    // Bind parameters
                    mysqli_stmt_bind_param($stmt, "ssiiiii", $nome, $descricao, $dia, $mes, $ambito, $animacao, $id);
                    // Execute the statement
                    mysqli_stmt_execute($stmt);
                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                        $_SESSION["updated"] = "Evento " . $nome . " atualizado com sucesso!";
                    }
                    //header('Location: ../../admin/eventos/edit.php?id=' . $_SESSION["evento"]["id_evento"]);
                    // Close the statement
                    mysqli_stmt_close($stmt);
                } else {
                    echo json_encode(array("error" => "Failed to prepare SQL statement."));
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
        header('Location: ../../admin/eventos/edit.php?id=' . $_SESSION["evento"]["id_evento"]);
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
