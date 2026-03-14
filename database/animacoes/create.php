<?php
require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES['objeto']) && isset($_FILES['textura'])) {
        $nome = $_POST["nome"];
        $sql = "SELECT * FROM animacoes WHERE nome = ?";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, 's', $nome);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $_SESSION["exists"] = "Já existe uma animação com o mesmo nome!";
            $_SESSION["color"] = "danger";
            mysqli_stmt_close($stmt);
            header('Location: ../../admin/animacoes/create.php');
            exit;
        }
        $texture = file_get_contents($_FILES['textura']['tmp_name']);
        $objeto = file_get_contents($_FILES['objeto']['tmp_name']);
        $sqlInsert = "INSERT INTO animacoes (nome,textura,objeto) VALUES (?,?,?)";
        $stmtInsert = mysqli_prepare($conn, $sqlInsert);

        if ($stmtInsert) {
            // Bind parameters
            mysqli_stmt_bind_param($stmtInsert, 'sbb', $nome, $null, $null);

            $null = NULL;
            mysqli_stmt_send_long_data($stmtInsert, 1, $texture);
            mysqli_stmt_send_long_data($stmtInsert, 2, $objeto);
            $resultInsert = mysqli_stmt_execute($stmtInsert);
            if ($resultInsert) {
                $_SESSION["exists"] = "Animação " . $nome . " criada com sucesso!";
                $_SESSION["color"] = "success";
            }
            header('Location: ../../admin/animacoes/index.php');
            // Close the statement
            mysqli_stmt_close($stmtInsert);
        } else {
            echo json_encode(array("error" => "Failed to prepare SQL statement."));
        }
        // Close the statement
        mysqli_stmt_close($stmtInsert);
    }
    // Access the form data
} else {
    // Handle the case where the form was not submitted
    echo "Please submit the form.";
}
mysqli_close($conn);
