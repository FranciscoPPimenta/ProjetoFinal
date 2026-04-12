<?php
require_once("../database/config.php");
session_start();


if (!isset($_SESSION["admin"])) {
    header("Location: login/login.php");
}

$keep = 'admin';

foreach ($_SESSION as $key => $value) {
    if ($key !== $keep) {
        unset($_SESSION[$key]);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">

</head>
<?php
$sql = "SELECT * FROM admin WHERE id_admin = ?";
$stmt = mysqli_prepare($conn, $sql);
$row = "";
if ($stmt) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $_SESSION["admin"]);

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
                <a class="nav-link" href="eventos/index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Eventos</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="escolas/index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Escolas</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cursos/index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Cursos</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="docentes/index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Docentes</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="animacoes/index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Animações</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ucs/index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Unidades Curriculares</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="ambitos/index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Âmbitos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admins/index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Administradores</span>
                </a>
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
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Escolas</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <?php
                                    $schools = [];
                                    $sql = "SELECT * FROM escolas";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $schools[] = $row;
                                        }
                                    } else {
                                        echo "No schools found.";
                                    }
                                    ?>
                                    <div id="schoolRowSize" class="row d-flex flex-wrap align-items-start"
                                        style="color: white;">
                                        <?php foreach ($schools as $school): ?>
                                            <div class="col-md-2" id="escola_<?= $school['id_escola'] ?>">
                                                <div class="card h-100 text-bg-dark card-admin">
                                                    <img src="../database/escolas/get_image.php?id=<?= $school['id_escola'] ?>"
                                                        class="card-img card-img-admin" alt="<?= $school["nome"] ?>"
                                                        style="width:100%; height:100%; border-radius:5px; object-fit:cover;">

                                                    <div class="card-img-overlay">
                                                        <p class="card-text"><?= $school['descricao'] ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <?php
                    $sql = "SELECT cursos.*,animacoes.nome as 'Animacao',escolas.nome as 'Escolas' FROM cursos INNER JOIN animacoes ON cursos.id_animacao = animacoes.id_animacao INNER JOIN escolas ON cursos.id_escola = escolas.id_escola";
                    $stmt = mysqli_prepare($conn, $sql);

                    if ($stmt) {
                        // Execute the statement
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $cursos = [];
                        // Get the result
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { // Use a loop to fetch all rows
                                $cursos[] = $row; // Assuming 'nome' is a column in the result set
                            }
                        }
                        // Close the statement
                        mysqli_stmt_close($stmt);
                    }
                    ?>
                    <!-- Page Heading -->

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div
                            class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Cursos</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Regime</th>
                                            <th>Descrição</th>
                                            <th>Evento</th>
                                            <th>Animação</th>
                                            <th>Escola</th>
                                            <th>Coordenador de Curso</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($cursos as $curso) {
                                        ?>
                                            <tr>
                                                <td><?php echo $curso['nome']; ?></td>
                                                <td><?php echo $curso['regime'] ?></td>
                                                <td><?php echo $curso['descricao']; ?></td>
                                                <?php
                                                $sql = "SELECT eventos.nome FROM eventos INNER JOIN cursos ON eventos.id_evento = cursos.id_evento WHERE cursos.id_evento = ?";
                                                $stmt = mysqli_prepare($conn, $sql);

                                                if ($stmt) {
                                                    mysqli_stmt_bind_param($stmt, "i", $curso["id_evento"]);
                                                    // Execute the statement
                                                    mysqli_stmt_execute($stmt);
                                                    $result = mysqli_stmt_get_result($stmt);
                                                    $string = "";
                                                    // Get the result
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) { // Use a loop to fetch all rows
                                                            $string = $row;
                                                        }
                                                    }
                                                    // Close the statement
                                                    mysqli_stmt_close($stmt);
                                                }
                                                ?>
                                                <td><?php echo $string["nome"]; ?></td>
                                                <td><?php echo $curso['Animacao']; ?></td>
                                                <?php
                                                $sql = "SELECT escolas.nome FROM escolas INNER JOIN cursos ON escolas.id_escola = cursos.id_escola WHERE cursos.id_escola = ?";
                                                $stmt = mysqli_prepare($conn, $sql);

                                                if ($stmt) {
                                                    mysqli_stmt_bind_param($stmt, "i", $curso["id_escola"]);
                                                    // Execute the statement
                                                    mysqli_stmt_execute($stmt);
                                                    $result = mysqli_stmt_get_result($stmt);
                                                    $escolas = [];
                                                    // Get the result
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) { // Use a loop to fetch all rows
                                                            $escolas[] = $row;
                                                        }
                                                    }
                                                    $nome_escola = "";
                                                    foreach ($escolas as $escola) {
                                                        $nome_escola = $escola["nome"];
                                                    }
                                                    // Close the statement
                                                    mysqli_stmt_close($stmt);
                                                }
                                                ?>
                                                <td><?php echo $nome_escola ?></td>
                                                <?php
                                                $sql = "SELECT docentes.nome FROM docentes INNER JOIN cursos ON docentes.id_docente = cursos.id_coordenador WHERE cursos.id_coordenador = ?";
                                                $stmt = mysqli_prepare($conn, $sql);

                                                if ($stmt) {
                                                    mysqli_stmt_bind_param($stmt, "i", $curso["id_coordenador"]);

                                                    // Execute the statement
                                                    mysqli_stmt_execute($stmt);
                                                    $result = mysqli_stmt_get_result($stmt);
                                                    $coordenadores = [];
                                                    // Get the result
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) { // Use a loop to fetch all rows
                                                            $coordenadores[] = $row;
                                                        }
                                                    }
                                                    $nome_coordenador = "";
                                                    foreach ($coordenadores as $coordenador) {
                                                        $nome_coordenador = $coordenador["nome"];
                                                    }
                                                    // Close the statement
                                                    mysqli_stmt_close($stmt);
                                                }
                                                ?>
                                                <td><?php echo $nome_coordenador ?></td>

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
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
                    <a class="btn btn-primary" href="eventos.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>