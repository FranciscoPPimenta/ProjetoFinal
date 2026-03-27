<?php
require_once 'database/index/escolas.php';
require_once 'database/index/cursos.php';
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <script type="importmap">
        {
      "imports": {
        "three": "https://cdn.jsdelivr.net/npm/three@0.149.0/build/three.module.js",
        "three/addons/": "https://cdn.jsdelivr.net/npm/three@0.149.0/examples/jsm/"
      }
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <title>ProjetoFinal</title>
</head>

<body>
    <div class="container-fluid" id="main">
        <div class="row">
            <div class="col-6 min-vh-100" id="left">
                <canvas id="c"></canvas>
            </div>
            <!-- justify-content-center centrado horizontalmente align-items-start para nao ocupar o espaco todo da col-->
            <div class="col-6 min-vh-100 d-flex justify-content-center align-items-start" id="right">
                <div class="container">
                    <div class="row">
                        <img src="assets/ipvc_Symbol.png" id="symbol" alt="ipvc">
                    </div>
                    <div class="row">
                        <p id="welcome" class="text-center">Bem-vindo ao IPVC. O
                            <strong>TEU</strong> ponto de partida.
                        </p>
                    </div>
                    <div class="row" style="margin-bottom: 120px;">
                        <h2 id="schools" class="text-center">Escolas</h2>
                    </div>
                    <?php foreach (array_chunk($schools, 3) as $schoolsRow): ?>
                        <div id="schoolRowSize" class="row d-flex flex-wrap align-items-start">
                            <?php foreach ($schoolsRow as $school): ?>
                                <div class="col-md-4" id="escola_<?= $school['id_escola'] ?>">
                                    <div class="card h-100 text-bg-dark">
                                        <img src="database/escolas/get_image.php?id=<?= $school['id_escola'] ?>"
                                            class="card-img" alt="<?= $school["nome"] ?>"
                                            style="width:100%; height:100%; border-radius:5px; object-fit:cover;">

                                        <div class="card-img-overlay">
                                            <h5 class="card-title"><?= $school['nome'] ?></h5>
                                            <p class="card-text"><?= $school['descricao'] ?></p>

                                            <button id="btn_<?= $school['id_escola'] ?>" class="btn btn-primary"
                                                onclick="changeSize(<?= $school['id_escola'] ?>)">
                                                <span class="span" id="span_<?= $school['id_escola'] ?>">Ver
                                                    Detalhes</span></button>
                                            <a href="database/index/cursos.php?id=<?= $school['id_escola'] ?>"
                                                id="details_<?= $school['id_escola'] ?>"
                                                class="btn btn-warning fade-element-hidden"
                                                onclick="disappear(<?= $school['id_escola'] ?>)">Ver
                                                Detalhes</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                    <div class="row" id="content">
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="module" src="js/index.js"></script>
    <script>
        function changeSize(id) {
            const targetId = `escola_${id}`;
            const buttonTargetId = `btn_${id}`;
            const detailsTargetId = `details_${id}`;
            const spanTarget = `span_${id}`

            document.querySelectorAll('[id^="escola_"]').forEach(div => {
                div.classList.remove('col-md-1', 'col-md-2', 'col-md-4', 'col-md-8', 'col-md-11');
                div.classList.add(div.id === targetId ? 'col-md-8' : 'col-md-2');
            });
            document.querySelectorAll('[id^="btn_"]').forEach(btn => {
                btn.classList.remove('btn-sm', 'btn-lg');
                btn.classList.add(btn.id !== buttonTargetId ? 'btn-sm' : 'btn-lg');
            });
            document.querySelectorAll('[id^="details_"]').forEach(btn => {
                btn.classList.remove('fade-element-hidden', 'fade-element', 'btn-sm', 'btn-lg');
                /**... -> operador spread -> expande o array em argumentos separados
                neste caso com o ... é como se tivesse
                "add('fade-element-hidden','btn-sm')"
                ou
                add('fade-element','btn-lg')
                **/
                btn.classList.add(
                    ...(btn.id !== detailsTargetId ? ['fade-element-hidden', 'btn-sm'] : ['fade-element',
                        'btn-lg'
                    ])
                );

            });

            if (document.getElementById('content').textContent.trim() !== "") {
                document.getElementById('content').textContent = "";
            }

            if (document.getElementById(spanTarget).innerHTML == "Voltar Atrás") {
                let on = true;

                // animate out

                const span = document.getElementById(spanTarget);
                const D = 2000; // ms - match your CSS transition duration

                span.classList.add("out");

                setTimeout(() => {
                    span.textContent = on ? "Ver Detalhes" : "Voltar Atrás";
                    on = !on;

                    requestAnimationFrame(() => span.classList.remove("out"));
                }, D);
            }
        }

        function disappear(id) {
            const targetId = `escola_${id}`;
            const buttonTargetId = `btn_${id}`;
            const detailsTargetId = `details_${id}`;
            const spanTarget = `span_${id}`
            document.querySelectorAll('[id^="escola_"]').forEach(div => {
                div.classList.remove('col-md-1', 'col-md-2', 'col-md-4', 'col-md-8', 'col-md-11');
                div.classList.add(...(div.id === targetId ? ['col-md-8'] : ['col-md-1']));
            });
            document.querySelectorAll('[id^="btn_"]').forEach(btn => {
                btn.classList.remove('btn-sm', 'btn-lg');
                btn.classList.add(btn.id !== buttonTargetId ? 'btn-sm' : 'btn-lg');
            });
            document.querySelectorAll('[id^="details_"]').forEach(btn => {
                btn.classList.remove('fade-element-hidden', 'fade-element', 'btn-sm', 'btn-lg');
                /**... -> operador spread -> expande o array em argumentos separados
                neste caso com o ... é como se tivesse
                "add('fade-element-hidden','btn-sm')"
                ou
                add('fade-element','btn-lg')
                **/
                btn.classList.add(
                    ...(btn.id !== detailsTargetId ? ['fade-element-hidden', 'btn-sm'] : [
                        'fade-element-hidden',
                        'btn-lg'
                    ])
                );
            });
            let on = true;

            // animate out

            const span = document.getElementById(spanTarget);
            const D = 2000; // ms - match your CSS transition duration

            span.classList.add("out");

            setTimeout(() => {
                span.textContent = on ? "Voltar Atrás" : "Ver Detalhes";
                on = !on;

                requestAnimationFrame(() => span.classList.remove("out"));
            }, D);

        }

        document.querySelectorAll('[id^="details_"]').forEach(btn => {
            btn.addEventListener('click', e => {
                e.preventDefault(); // stop normal page reload

                const url = btn.getAttribute('href'); // e.g. details.php?id=X
                console.log(url);
                fetch(url)
                    .then(res => res.text())
                    .then(html => {
                        document.getElementById('content').innerHTML = html;
                    });
            });
        });
    </script>
</body>

</html>