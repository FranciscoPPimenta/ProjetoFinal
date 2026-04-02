<?php
require_once __DIR__ . '/../config.php';

$cursos = [];
$sql = "SELECT * FROM cursos WHERE id_escola = ?";
$stmt = mysqli_prepare($conn, $sql);

if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = (int) $_GET['id'];
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $cursos[] = $row;
        }
        mysqli_stmt_close($stmt);
    }
}

?>
<div>
    <?php if (!empty($cursos)): ?>
        <div style="margin:20px" class="row g-3">
            <?php foreach ($cursos as $curso): ?>
                <div id="curso" class="col-md-6">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= htmlspecialchars($curso['nome'] ?? 'Curso', ENT_QUOTES, 'UTF-8') ?>
                            </h5>
                            <?php if (!empty($curso['descricao'])): ?>
                                <p class="card-text">
                                    <?= nl2br(htmlspecialchars($curso['descricao'], ENT_QUOTES, 'UTF-8')) ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>