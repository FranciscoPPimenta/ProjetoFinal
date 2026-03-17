<?php
require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request
if (isset($_GET['id'])) {
    $id = $_GET['id'];

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
