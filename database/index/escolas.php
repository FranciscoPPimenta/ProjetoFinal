<?php
require_once __DIR__ . '/../config.php';

$school = [];
$sql = "SELECT escolas.* , animacoes.textura as 'Textura', animacoes.objeto as 'Objeto' FROM escolas INNER JOIN animacoes ON escolas.id_animacao = animacoes.id_animacao";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $schools[] = $row;
        }
    }
    mysqli_stmt_close($stmt);
}
