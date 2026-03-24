<?php
require_once 'database/index/escolas.php';
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
                    <div class="row">
                        <h2 id="schools" class="text-center">Escolas</h2>
                    </div>
                    <div class="row"></div>
                </div>
            </div>
        </div>
    </div>
    <script type="module" src="js/index.js"></script>
</body>

</html>