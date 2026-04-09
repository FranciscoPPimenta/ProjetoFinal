<?php
require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nomeAdmin']) != "") {
        $nome = $_POST['nomeAdmin'];
        $password = password_hash($_POST["passwordAdmin"], PASSWORD_DEFAULT);
        $sql = "SELECT * FROM admin WHERE admin_name = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $nome);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION["exists"] = "Já existe um adminstrador com esse nome!";
                $_SESSION["color"] = "danger";
                header('Location: ../../admin/admins/index.php');
            }
        }
        mysqli_stmt_close($stmt);

        $sql = "INSERT INTO admin (admin_name,admin_pass) VALUES (?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ss', $nome, $password);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                $_SESSION["exists"] = "Novo Adminstrador adicionado!";
                $_SESSION["color"] = "success";
            }
            header('Location: ../../admin/docentes/index.php');
            mysqli_stmt_close($stmt);
        }
    }
    // Access the form data
} else {
    // Handle the case where the form was not submitted
    echo "Please submit the form.";
}
mysqli_close($conn);
