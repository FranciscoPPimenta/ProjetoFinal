<?php
require_once '../config.php';
session_start();
// Check if the 'id' parameter is provided in the request

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nomeEscola']) && isset($_POST['descricaoEscola'])) {
        $nome = $_POST['nomeEscola'];
        $desc = $_POST['descricaoEscola'];
        $ani = $_POST['animacaoEscola'];
        $sql = "SELECT * FROM escolas WHERE nome = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $nome);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION["exists"] = "Já existe uma escola com o mesmo nome!";
                $_SESSION["color"] = "danger";
                mysqli_stmt_close($stmt);
                header('Location: ../../admin/escolas/create.php');
                exit;
            }

            mysqli_stmt_close($stmt);
            if (isset($_FILES['imageEscola'])) {
                $imagem = file_get_contents($_FILES['imageEscola']['tmp_name']);
                $mimeType = mime_content_type($_FILES['imageEscola']['tmp_name']);
                $imageName = $_FILES["imageEscola"]['name'];
                $sql = "INSERT INTO escolas (nome,descricao,id_animacao,imagem,mime_type,imagem_name) VALUES (?,?,?,?,?,?)";
                $stmt = mysqli_prepare($conn, $sql);
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, 'ssibbs', $nome, $desc, $ani, $null, $null, $imageName);
                    $null = NULL;
                    mysqli_stmt_send_long_data($stmt, 3, $imagem);
                    mysqli_stmt_send_long_data($stmt, 4, $mimeType);
                    $result = mysqli_stmt_execute($stmt);
                    if ($result) {
                        $_SESSION["exists"] = "Nova Escola adicionada!";
                        $_SESSION["color"] = "success";
                    }
                    header('Location: ../../admin/escolas/index.php');
                    mysqli_stmt_close($stmt);
                }
            }
        }
    }
    // Access the form data
} else {
    // Handle the case where the form was not submitted
    echo "Please submit the form.";
}
mysqli_close($conn);
