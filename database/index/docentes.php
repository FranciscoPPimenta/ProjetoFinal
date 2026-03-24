<?php
require_once __DIR__ . '/../config.php';

$school = [];
$sql = "SELECT * FROM docentes";
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
