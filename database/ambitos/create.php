<?php
require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nomeAmbito']) != "") {
        $nome = $_POST['nomeAmbito'];
        $sql = "INSERT INTO ambitos (nome) VALUES (?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $nome);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                $_SESSION["exists"] = "Novo Ambito adicionado!";
                $_SESSION["color"] = "success";
            }
            header('Location: ../../admin/ambitos/index.php');
            mysqli_stmt_close($stmt);
        }
    }
    // Access the form data
} else {
    // Handle the case where the form was not submitted
    echo "Please submit the form.";
}
mysqli_close($conn);
