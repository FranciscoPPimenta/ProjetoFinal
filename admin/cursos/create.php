<?php
require_once("../../database/config.php");
session_start();
// if(!isset($_SESSION["userID"])){
//     header("Location: ../../login.php");
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <title>Admin - Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

    <script type="importmap">
        {
      "imports": {
        "three": "https://cdn.jsdelivr.net/npm/three@0.149.0/build/three.module.js",
        "three/addons/": "https://cdn.jsdelivr.net/npm/three@0.149.0/examples/jsm/"
      }
    }
  </script>

</head>
<?php
$sql = "SELECT * FROM admins WHERE id_admin = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $_SESSION["userID"]);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }
    // Close the statement
    mysqli_stmt_close($stmt);
}
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Páginas
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="../eventos/index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Eventos</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../escolas/index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Escolas</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Cursos</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../professores/index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Professores</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../animacoes/index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Animações</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../ucs/index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Unidades Curriculares</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $row["admin_name"] ?></span>
                                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="card mb-12">
                        <?php
                        if (isset($_SESSION["exists"])) {
                            echo '<p style="margin-left:10px" class="fs-3 text-' . $_SESSION["color"] . '">' . $_SESSION["exists"] . '</p>';
                        }
                        ?>
                        <div class="row g-0">
                            <div class="col-md-4" id="canvas" style="height:30vh">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <form id="form" method="POST">
                                        <?php
                                        if (isset($_SESSION["create_nome"])) {
                                            echo '<input type="text" style="margin:5px;font-size:20px" class="form-control"value="' . $_SESSION["create_nome"] . '" name="nome" id="nome" required>';
                                        } else {
                                            echo '<input type="text" style="margin:5px;font-size:20px" class="form-control" name="nome" id="nome" required>';
                                        }
                                        ?>
                                        <?php
                                        if (isset($_SESSION["create_desc"])) {
                                            echo '<textarea style="margin:5px;font-size:20px" name="descricao" id="descricao" class="form-control" required>' . $_SESSION["create_desc"] . '</textarea>';
                                        } else {
                                            echo '<textarea style="margin:5px;font-size:20px" name="descricao" id="descricao" class="form-control" required></textarea>';
                                        }
                                        ?>
                                        <select style="margin:5px;font-size:20px" class="form-control" name="regime"
                                            id="regime" required>
                                            <?php
                                            if (isset($_SESSION["create_regime"])) {
                                                if ($_SESSION["create_regime"] == "Diurno") {
                                                    echo '
                                                                <option value="" disabled>Selecione um regime</option>
                                                                <option selected value="Diurno">Diurno</option>
                                                                <option value="Noturno">Noturno</option>';
                                                } else {
                                                    echo '
                                                                <option value="" disabled>Selecione um regime</option>
                                                                <option value="Diurno">Diurno</option>
                                                                <option selected value="Noturno">Noturno</option>';
                                                }
                                            } else {
                                                echo '
                                                                <option selected value="" disabled>Selecione um regime</option>
                                                                <option value="Diurno">Diurno</option>
                                                                <option value="Noturno">Noturno</option>';
                                            }
                                            ?>

                                        </select>
                                        <?php
                                        $sql = "SELECT * from docentes";
                                        $stmt = mysqli_prepare($conn, $sql);

                                        if ($stmt) {
                                            // Execute the statement
                                            mysqli_stmt_execute($stmt);
                                            $result = mysqli_stmt_get_result($stmt);
                                            $profs = array();
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $profs[] = $row;
                                            }

                                            // Close the statement
                                            mysqli_stmt_close($stmt);
                                        }
                                        ?>
                                        <?php
                                        if (isset($_SESSION["professor_curso"])) {
                                        ?>
                                            <select style="margin:5px;font-size:20px" class="form-control"
                                                name="professores" id="professores" required>
                                                <option value="" disabled>Selecione um coordenador</option>
                                                <?php
                                                foreach ($profs as $prof) {
                                                    if ($prof['id_professor'] == $_SESSION['professor_curso']) {
                                                        echo '<option value="' . $prof['id_professor'] . '" selected>' . $prof["nome"] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $prof['id_professor'] . '">' . $prof["nome"] . '</option>';
                                                    }
                                                }
                                            } else {
                                                ?>
                                                <select style="margin:5px;font-size:20px" class="form-control"
                                                    name="professores" id="professores" required>
                                                    <option value="" selected disabled>Selecione um coordenador</option>
                                                <?php
                                                foreach ($profs as $prof) {
                                                    echo '<option value="' . $prof['id_professor'] . '">' . $prof["nome"] . '</option>';
                                                }
                                            }
                                                ?>
                                                </select>
                                                <?php
                                                $sql = "SELECT * from escolas";
                                                $stmt = mysqli_prepare($conn, $sql);

                                                if ($stmt) {
                                                    // Execute the statement
                                                    mysqli_stmt_execute($stmt);
                                                    $result = mysqli_stmt_get_result($stmt);
                                                    $unidades = array();
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $unidades[] = $row;
                                                    }

                                                    // Close the statement
                                                    mysqli_stmt_close($stmt);
                                                }
                                                ?>
                                                <?php
                                                if (isset($_SESSION["unidade_curso"])) {
                                                ?>
                                                    <select style="margin:5px;font-size:20px" class="form-control"
                                                        name="unidade" id="unidade" required>
                                                        <option value="" disabled>Selecione uma escpça</option>
                                                        <?php
                                                        foreach ($unidades as $unidade) {
                                                            if ($unidade['id_unidade'] == $_SESSION['unidade_curso']) {
                                                                echo '<option value="' . $unidade['id_unidade'] . '" selected>' . $unidade["nome"] . '</option>';
                                                            } else {
                                                                echo '<option value="' . $unidade['id_unidade'] . '">' . $unidade["nome"] . '</option>';
                                                            }
                                                        }
                                                    } else {
                                                        ?>
                                                        <select style="margin:5px;font-size:20px" class="form-control"
                                                            name="unidade" id="unidade" required>
                                                            <option value="" selected disabled>Selecione uma escola
                                                            </option>
                                                        <?php
                                                        foreach ($unidades as $unidade) {
                                                            echo '<option value="' . $unidade['id_unidade'] . '">' . $unidade["nome"] . '</option>';
                                                        }
                                                    }
                                                        ?>
                                                        </select>
                                                        <?php
                                                        $sql = "SELECT * from eventos";
                                                        $stmt = mysqli_prepare($conn, $sql);

                                                        if ($stmt) {
                                                            // Execute the statement
                                                            mysqli_stmt_execute($stmt);
                                                            $result = mysqli_stmt_get_result($stmt);
                                                            $eventos = array();
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $eventos[] = $row;
                                                            }

                                                            // Close the statement
                                                            mysqli_stmt_close($stmt);
                                                        }
                                                        ?>
                                                        <?php

                                                        if (isset($_SESSION["evento_curso"])) {
                                                        ?>
                                                            <select style="margin:5px;font-size:20px" class="form-control"
                                                                name="eventos" id="eventos" required>
                                                                <option value="" disabled>Selecione um evento</option>
                                                                <?php
                                                                foreach ($eventos as $evento) {
                                                                    if ($evento['id_evento'] == $evento['evento_curso']) {
                                                                        echo '<option value="' . $evento['id_evento'] . '" selected>' . $evento["nome"] . '</option>';
                                                                    } else {
                                                                        echo '<option value="' . $evento['id_evento'] . '">' . $evento["nome"] . '</option>';
                                                                    }
                                                                }
                                                            } else {
                                                                ?>
                                                                <select style="margin:5px;font-size:20px" class="form-control"
                                                                    name="eventos" id="eventos" required>
                                                                    <option value="" selected disabled>Selecione um evento</option>
                                                                <?php
                                                                foreach ($eventos as $evento) {
                                                                    echo '<option value="' . $evento['id_evento'] . '">' . $evento["nome"] . '</option>';
                                                                }
                                                            }
                                                                ?>
                                                                </select>
                                                                <?php
                                                                $sql = "SELECT * from animacoes";
                                                                $stmt = mysqli_prepare($conn, $sql);

                                                                if ($stmt) {
                                                                    // Execute the statement
                                                                    mysqli_stmt_execute($stmt);
                                                                    $result = mysqli_stmt_get_result($stmt);
                                                                    $animacoes = array();
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        $animacoes[] = $row;
                                                                    }

                                                                    // Close the statement
                                                                    mysqli_stmt_close($stmt);
                                                                }
                                                                ?>
                                                                <?php
                                                                if (isset($_SESSION["animacao_textura"])) {
                                                                ?>
                                                                    <select style="margin:5px;font-size:20px" class="form-control"
                                                                        name="animacao" id="animacao" required>
                                                                        <option value="" disabled>Selecione uma animação</option>
                                                                        <?php
                                                                        foreach ($animacoes as $animacao) {
                                                                            if ($animacao['id_animacao'] == $_SESSION['animacao_id']) {
                                                                                echo '<option value="' . $animacao['id_animacao'] . '" selected>' . $animacao["nome"] . '</option>';
                                                                            } else {
                                                                                echo '<option value="' . $animacao['id_animacao'] . '">' . $animacao["nome"] . '</option>';
                                                                            }
                                                                        }
                                                                    } else {
                                                                        ?>
                                                                        <select style="margin:5px;font-size:20px" class="form-control"
                                                                            name="animacao" id="animacao" required>
                                                                            <option value="" selected disabled>Selecione uma animação
                                                                            </option>
                                                                        <?php
                                                                        foreach ($animacoes as $animacao) {
                                                                            echo '<option value="' . $animacao['id_animacao'] . '">' . $animacao["nome"] . '</option>';
                                                                        }
                                                                    }
                                                                        ?>
                                                                        </select>
                                                                        <div class="modal fade" id="createModal" tabindex="-1"
                                                                            aria-labelledby="createModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h1 class="modal-title fs-5"
                                                                                            id="createModalLabel">Criar Curso</h1>
                                                                                        <button type="button" class="btn-close"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body" id="createModalBody">
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary"
                                                                                            data-bs-dismiss="modal">Não</button>
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary">Sim</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                    </form>
                                </div>
                                <button type="button" id="createButton" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#createModal" onclick="setCreateModalText()">Criar Curso</button>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- Begin Page Content -->

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script>


    </script>
    <script type="module" src="../js/3D/3D.js"></script>
    <script type="module">
        import {
            objeto
        } from '../js/3D/3D.js';

        document.getElementById("animacao").addEventListener("change", function() {
            // Get the selected value
            var selectedValue = document.getElementById("animacao").value;
            if (document.getElementById("nome").value != "") {
                if (document.getElementById("descricao").value != "") {
                    if (document.getElementById("professores").value != "") {
                        if (document.getElementById("regime").value != "") {
                            if (document.getElementById("unidade").value != "") {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&desc=" + document.getElementById("descricao").value + "&professores=" +
                                        document.getElementById("professores").value + "&page=cursos&regime=" +
                                        document.getElementById("regime").value + "&unidade=" + document
                                        .getElementById("unidade").value + "&evento=" + document.getElementById(
                                            "eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&desc=" + document.getElementById("descricao").value + "&professores=" +
                                        document.getElementById("professores").value + "&page=cursos&regime=" +
                                        document.getElementById("regime").value + "&unidade=" + document
                                        .getElementById("unidade").value;
                                }
                            } else {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&desc=" + document.getElementById("descricao").value + "&professores=" +
                                        document.getElementById("professores").value + "&page=cursos&regime=" +
                                        document.getElementById("regime").value + "&evento=" + document
                                        .getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&desc=" + document.getElementById("descricao").value + "&professores=" +
                                        document.getElementById("professores").value + "&page=cursos&regime=" +
                                        document.getElementById("regime").value;
                                }
                            }
                        } else {
                            if (document.getElementById("unidade").value != "") {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&desc=" + document.getElementById("descricao").value + "&professores=" +
                                        document.getElementById("professores").value + "&page=cursos&unidade=" +
                                        document.getElementById("unidade").value + "&evento=" + document
                                        .getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&desc=" + document.getElementById("descricao").value + "&professores=" +
                                        document.getElementById("professores").value + "&page=cursos&unidade=" +
                                        document.getElementById("unidade").value;
                                }
                            } else {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&desc=" + document.getElementById("descricao").value + "&professores=" +
                                        document.getElementById("professores").value + "&page=cursos&evento=" +
                                        document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&desc=" + document.getElementById("descricao").value + "&professores=" +
                                        document.getElementById("professores").value + "&page=cursos";
                                }
                            }
                        }
                    } else {
                        if (document.getElementById("regime").value != "") {
                            if (document.getElementById("unidade").value != "") {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&desc=" + document.getElementById("descricao").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&unidade=" + document.getElementById("unidade").value + "&evento=" +
                                        document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&desc=" + document.getElementById("descricao").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&unidade=" + document.getElementById("unidade").value;
                                }
                            } else {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&desc=" + document.getElementById("descricao").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&desc=" + document.getElementById("descricao").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value;
                                }
                            }
                        } else {
                            if (document.getElementById("unidade").value != "") {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&desc=" + document.getElementById("descricao").value +
                                        "&page=cursos&unidade=" + document.getElementById("unidade").value +
                                        "&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&desc=" + document.getElementById("descricao").value +
                                        "&page=cursos&unidade=" + document.getElementById("unidade").value;
                                }
                            } else {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&desc=" + document.getElementById("descricao").value +
                                        "&page=cursos&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&desc=" + document.getElementById("descricao").value + "&page=cursos";
                                }
                            }
                        }
                    }
                } else {
                    if (document.getElementById("professores").value != "") {
                        if (document.getElementById("regime").value != "") {
                            if (document.getElementById("unidade").value != "") {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&professores=" + document.getElementById("professores").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&unidade=" + document.getElementById("unidade").value + "&evento=" +
                                        document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&professores=" + document.getElementById("professores").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&unidade=" + document.getElementById("unidade").value;
                                }
                            } else {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&professores=" + document.getElementById("professores").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&professores=" + document.getElementById("professores").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value;
                                }
                            }
                        } else {
                            if (document.getElementById("unidade").value != "") {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&professores=" + document.getElementById("professores").value +
                                        "&page=cursos&unidade=" + document.getElementById("unidade").value +
                                        "&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&professores=" + document.getElementById("professores").value +
                                        "&page=cursos&unidade=" + document.getElementById("unidade").value;
                                }
                            } else {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&professores=" + document.getElementById("professores").value +
                                        "&page=cursos&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&professores=" + document.getElementById("professores").value +
                                        "&page=cursos";
                                }
                            }
                        }
                    } else {
                        if (document.getElementById("regime").value != "") {
                            if (document.getElementById("unidade").value != "") {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&unidade=" + document.getElementById("unidade").value + "&evento=" +
                                        document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&unidade=" + document.getElementById("unidade").value;
                                }
                            } else {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value;
                                }
                            }
                        } else {
                            if (document.getElementById("unidade").value != "") {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&page=cursos&unidade=" + document.getElementById("unidade").value +
                                        "&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&page=cursos&unidade=" + document.getElementById("unidade").value;
                                }
                            } else {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&page=cursos&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&nome=" + document.getElementById("nome").value +
                                        "&page=cursos";
                                }
                            }
                        }
                    }
                }
            } else {
                if (document.getElementById("descricao").value != "") {
                    if (document.getElementById("professores").value != "") {
                        if (document.getElementById("regime").value != "") {
                            if (document.getElementById("unidade").value != "") {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&desc=" + document.getElementById("descricao").value +
                                        "&professores=" + document.getElementById("professores").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&unidade=" + document.getElementById("unidade").value + "&evento=" +
                                        document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&desc=" + document.getElementById("descricao").value +
                                        "&professores=" + document.getElementById("professores").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&unidade=" + document.getElementById("unidade").value;
                                }
                            } else {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&desc=" + document.getElementById("descricao").value +
                                        "&professores=" + document.getElementById("professores").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&desc=" + document.getElementById("descricao").value +
                                        "&professores=" + document.getElementById("professores").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value;
                                }
                            }
                        } else {
                            if (document.getElementById("unidade").value != "") {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&desc=" + document.getElementById("descricao").value +
                                        "&professores=" + document.getElementById("professores").value +
                                        "&page=cursos&unidade=" + document.getElementById("unidade").value +
                                        "&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&desc=" + document.getElementById("descricao").value +
                                        "&professores=" + document.getElementById("professores").value +
                                        "&page=cursos&unidade=" + document.getElementById("unidade").value;
                                }
                            } else {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&desc=" + document.getElementById("descricao").value +
                                        "&professores=" + document.getElementById("professores").value +
                                        "&page=cursos&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&desc=" + document.getElementById("descricao").value +
                                        "&professores=" + document.getElementById("professores").value +
                                        "&page=cursos";
                                }
                            }
                        }
                    } else {
                        if (document.getElementById("regime").value != "") {
                            if (document.getElementById("unidade").value != "") {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&desc=" + document.getElementById("descricao").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&unidade=" + document.getElementById("unidade").value + "&evento=" +
                                        document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&desc=" + document.getElementById("descricao").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&unidade=" + document.getElementById("unidade").value;
                                }
                            } else {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&desc=" + document.getElementById("descricao").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&desc=" + document.getElementById("descricao").value +
                                        "&page=cursos&regime=" + document.getElementById("regime").value;
                                }
                            }
                        } else {
                            if (document.getElementById("unidade").value != "") {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&desc=" + document.getElementById("descricao").value +
                                        "&page=cursos&unidade=" + document.getElementById("unidade").value +
                                        "&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&desc=" + document.getElementById("descricao").value +
                                        "&page=cursos&unidade=" + document.getElementById("unidade").value;
                                }
                            } else {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&desc=" + document.getElementById("descricao").value +
                                        "&page=cursos&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&desc=" + document.getElementById("descricao").value +
                                        "&page=cursos";
                                }
                            }
                        }
                    }
                } else {
                    if (document.getElementById("professores").value != "") {
                        if (document.getElementById("regime").value != "") {
                            if (document.getElementById("unidade").value != "") {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&professores=" + document.getElementById("professores")
                                        .value + "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&unidade=" + document.getElementById("unidade").value + "&evento=" +
                                        document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&professores=" + document.getElementById("professores")
                                        .value + "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&unidade=" + document.getElementById("unidade").value;
                                }
                            } else {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&professores=" + document.getElementById("professores")
                                        .value + "&page=cursos&regime=" + document.getElementById("regime").value +
                                        "&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&professores=" + document.getElementById("professores")
                                        .value + "&page=cursos&regime=" + document.getElementById("regime").value;
                                }
                            }
                        } else {
                            if (document.getElementById("unidade").value != "") {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&professores=" + document.getElementById("professores")
                                        .value + "&page=cursos&unidade=" + document.getElementById("unidade")
                                        .value + "&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&professores=" + document.getElementById("professores")
                                        .value + "&page=cursos&unidade=" + document.getElementById("unidade").value;
                                }
                            } else {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&professores=" + document.getElementById("professores")
                                        .value + "&page=cursos&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&professores=" + document.getElementById("professores")
                                        .value + "&page=cursos";
                                }
                            }
                        }
                    } else {
                        if (document.getElementById("regime").value != "") {
                            if (document.getElementById("unidade").value != "") {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&page=cursos&regime=" + document.getElementById("regime")
                                        .value + "&unidade=" + document.getElementById("unidade").value +
                                        "&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&page=cursos&regime=" + document.getElementById("regime")
                                        .value + "&unidade=" + document.getElementById("unidade").value;
                                }
                            } else {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&page=cursos&regime=" + document.getElementById("regime")
                                        .value + "&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&page=cursos&regime=" + document.getElementById("regime")
                                        .value;
                                }
                            }
                        } else {
                            if (document.getElementById("unidade").value != "") {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&page=cursos&unidade=" + document.getElementById("unidade")
                                        .value + "&evento=" + document.getElementById("eventos").value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&page=cursos&unidade=" + document.getElementById("unidade")
                                        .value;
                                }
                            } else {
                                if (document.getElementById("eventos").value != "") {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&page=cursos&evento=" + document.getElementById("eventos")
                                        .value;
                                } else {
                                    window.location.href = "../../database/animacao/get_animacao.php?id=" +
                                        selectedValue + "&page=cursos";
                                }
                            }
                        }
                    }
                }
            }
        });

        <?php
        if (isset($_SESSION["animacao_textura"])) { ?>
            console.log("aur");
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(function() {
                    objeto(<?php echo json_encode(base64_encode($_SESSION['animacao_textura'])) ?>, (
                        <?php echo json_encode(base64_encode($_SESSION['animacao_objeto'])) ?>));
                }, 1000); // Delay of 5 seconds
            });
        <?php
        }
        ?>
    </script>

    <script>
        function setCreateModalText() {
            if (!document.getElementById("unidade").value == "" && !document.getElementById("unidade").value == "" && !
                document.getElementById("unidade").value == "" && !document.getElementById("unidade").value == "" && !
                document.getElementById("unidade").value == "" && !document.getElementById("unidade").value == "") {
                var string = "De certeza que quer criar o curso?</br>" +
                    "Campos para o Curso</br>" +
                    "Nome: " + document.getElementById("nome").value + "</br>" +
                    "Descrição: " + document.getElementById("descricao").value + "</br>" +
                    "Coordenador: " + document.getElementById("professores").options[document.getElementById("professores")
                        .selectedIndex].text + "</br>" +
                    "Regime: " + document.getElementById("regime").options[document.getElementById("regime").selectedIndex]
                    .text + "</br>" +
                    "Unidade: " + document.getElementById("unidade").options[document.getElementById("unidade")
                        .selectedIndex].text + "</br>" +
                    "Animação: " + document.getElementById("animacao").options[document.getElementById("animacao")
                        .selectedIndex].text;
                document.getElementById("createModalBody").innerHTML = string;
            } else {
                document.getElementById("createModalBody").innerHTML = "Por favor preencha/selecione todos os campos!";
            }
            document.getElementById("form").action = '../../database/cursos/create.php';
        }
    </script>
    <?php
    $keep = 'userID';

    foreach ($_SESSION as $key => $value) {
        if ($key !== $keep) {
            unset($_SESSION[$key]);
        }
    }
    ?>
</body>

</html>