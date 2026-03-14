<?php
require_once("../config.php");
session_start();

header('Content-Type: application/json');

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    echo json_encode(["error" => "Invalid id"]);
    exit;
}

$sql = "SELECT textura, objeto FROM animacoes WHERE id_animacao = ?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    echo json_encode(["error" => "Prepare failed: " . mysqli_error($conn)]);
    exit;
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode([
        "textura" => base64_encode($row["textura"]),
        "objeto"  => base64_encode($row["objeto"])
    ]);
} else {
    echo json_encode(["error" => "Not found"]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
