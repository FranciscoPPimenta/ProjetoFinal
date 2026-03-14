<?php
require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nomeEscola']) && isset($_POST['descricaoEscola'])) {
        $nome = $_POST['nomeEscola'];
        $desc = $_POST['descricaoEscola'];
        $ani = $_POST['animacaoEscola'];
        $sql = "INSERT INTO escolas (nome,descricao,id_animacao) VALUES (?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ssi', $nome, $desc, $ani);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                $_SESSION["exists"] = "Nova Escola adicionado!";
                $_SESSION["color"] = "success";
            }
            header('Location: ../../admin/escolas/index.php');
            mysqli_stmt_close($stmt);
        }
    }
    // Access the form data
} else {
    // Handle the case where the form was not submitted
    echo "Please submit the form.";
}
mysqli_close($conn);
