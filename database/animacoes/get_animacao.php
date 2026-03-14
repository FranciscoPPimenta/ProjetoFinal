<?php
require_once '../config.php';

session_start();

/**
 * Leitura de parametros obrigatorios
 */
$id   = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$page = filter_input(INPUT_GET, 'page', FILTER_UNSAFE_RAW);

if (!$id || !$page) {
    http_response_code(400);
    exit("Required parameters missing: id/page");
}


$sql  = "SELECT id_animacao, textura, objeto FROM animacoes WHERE id_animacao = ?";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    http_response_code(500);
    exit("Error preparing query");
}

mysqli_stmt_bind_param($stmt, "i", $id);

mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row    = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);
mysqli_close($conn);

if (!$row) {
    $_SESSION["exists"] = "No animation found for the selected ID.";
    $_SESSION["color"]  = "danger";
    header("Location: ../../admin/$page/create.php");
    exit;
}

/**
 * Guardar animacao
 */
$_SESSION["animacao_textura"] = $row["textura"];
$_SESSION["animacao_objeto"]  = $row["objeto"];
$_SESSION["animacao_id"]      = $row["id_animacao"];

/**
 * Map de parametros 
 */
$map = [
    'nome'        => 'create_nome',
    'desc'        => 'create_desc',
    'ambito'      => 'create_ambito',
    'data'        => 'create_data',
    'professores' => 'professor_curso',
    'regime'      => 'create_regime',
    'unidade'     => 'unidade_curso',
    'evento'      => 'evento_curso',
];

// Loop through the map and save existing GET values into the session
foreach ($map as $getKey => $sessionKey) {
    if (isset($_GET[$getKey]) && $_GET[$getKey] !== '') {
        $_SESSION[$sessionKey] = $_GET[$getKey];
    }
}

header("Location: ../../admin/$page/create.php");
exit;
