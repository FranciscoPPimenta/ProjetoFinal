<?php
require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Access the form data
        $sql = "SELECT * FROM escolas WHERE nome = ? AND id_escola != ?";
        $stmt = mysqli_prepare($conn, $sql);
        $nome = $_POST["nome"];
        $animacao = $_POST["animacao"];
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $nome, $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) > 0) {
                $_SESSION["exists"] = "Já existe uma escola com esse nome!";
                $_SESSION["color"] = "danger";
                header('Location: ../../admin/escolas/edit.php?id=' . $_SESSION["escola"]["id_escola"]);
                mysqli_stmt_close($stmt);
            } else {
                $descricao = $_POST["descricao"];

                //Prepare the SQL statement
                $sql = "UPDATE escolas SET nome = ? , descricao = ?, id_animacao = ? WHERE id_escola = ?";
                $stmt = mysqli_prepare($conn, $sql);

                if ($stmt) {
                    // Bind parameters
                    mysqli_stmt_bind_param($stmt, "ssii", $nome, $descricao, $animacao, $id);
                    // Execute the statement
                    mysqli_stmt_execute($stmt);
                    if (mysqli_stmt_affected_rows($stmt) > 0) {
                        $_SESSION["updated"] = "Escola " . $nome . " atualizada com sucesso!";
                    }
                    header('Location: ../../admin/escolas/edit.php?id=' . $_SESSION["escolas"]["id_escola"]);
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
    $sql = "SELECT escolas.* , animacoes.nome as 'Animacao',animacoes.textura as 'Textura',animacoes.objeto as 'Objeto' FROM escolas INNER JOIN animacoes ON escolas.id_animacao = animacoes.id_animacao WHERE id_escola = ?";
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
            $_SESSION["escola"] = $row;
        }
        header('Location: ../../admin/escolas/edit.php?id=' . $_SESSION["escola"]["id_escola"]);
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
