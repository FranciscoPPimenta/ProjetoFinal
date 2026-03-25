<?php
require_once '../config.php';

if (!isset($_GET['id'])) {
    http_response_code(400);
    exit('Missing ID');
}

$id = (int)$_GET['id'];

$sql = "SELECT imagem, mime_type FROM escolas WHERE id_escola = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {

    $blob = $row['imagem'];

    // Safety check: empty image?
    if (!$blob) {
        http_response_code(404);
        exit('No image found');
    }

    // Detect mime_type if not stored
    if (!empty($row['mime_type'])) {
        $mime = $row['mime_type'];
    } else {
        // Detect mime from blob
        $info = @getimagesizefromstring($blob);
        $mime = $info['mime'] ?? 'image/jpeg';
    }

    header("Content-Type: $mime");
    header("Content-Length: " . strlen($blob));
    echo $blob;
} else {
    http_response_code(404);
    echo "Not found";
}
