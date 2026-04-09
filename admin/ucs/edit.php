<?php
require_once __DIR__ . "\..\..\database\config.php";
session_start();


if (!isset($_SESSION["admin"])) {
    header("Location: ../login/login.php");
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../css/loading.css">

    <title>Admin - UCS</title>
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
    <div id="loading">
        <div class="arc-loader" role="status" aria-label="Loading">
            <svg viewBox="0 0 50 50" class="arc-svg">
                <circle class="arc" cx="25" cy="25" r="20" fill="none" stroke-width="5" stroke-linecap="round" />
            </svg>
        </div>
        <p class="mt-3 text-center">Loading animation...</p>
    </div>
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
            <<li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Eventos</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../escolas/index.php">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Escolas</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../cursos/index.php">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Cursos</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../docentes/index.php">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Docentes</span></a>
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
                <li class="nav-item">
                    <a class="nav-link" href="../ambitos/index.php">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Âmbitos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admins/index.php">
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
                <?php
                if (isset($_SESSION["uc"])) {
                    //echo base64_encode($_SESSION["evento"]['Textura']);
                ?>
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <div class="card mb-12">
                            <div class="row g-0">
                                <div class="col-md-4" id="canvas" style="height:30vh">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body" id="notEditing">
                                        <p style="font-size:80px" class="card-title">
                                            <?php echo $_SESSION["uc"]["nome"]; ?></p>
                                        <p style="font-size:45px" class="card-text">
                                            <?php echo $_SESSION["uc"]["descricao"]; ?></p>
                                        <p style="font-size:30px" class="card-text">Curso:
                                            <?php echo $_SESSION["uc"]["Curso"]; ?></p>
                                        <?php
                                        $nomes = $_SESSION['nome_docentes'];
                                        $string = implode(', ', array_column($nomes, 'nome'));
                                        ?>
                                        <p style="font-size:30px" class="card-text">Docentes:
                                            <?php echo $string ?></p>
                                        <p style="font-size:30px" class="card-text">Animação:
                                            <?php echo $_SESSION["uc"]["Animacao"]; ?></p>

                                    </div>
                                    <div class="card-body" id="Editing" hidden>
                                        <form
                                            action='../../database/ucs/edit.php?id=<?php echo $_SESSION['uc']['id_uc']; ?>'
                                            method="POST">
                                            <input type="text" style="margin:5px;font-size:20px" class="form-control"
                                                name="nome" id="nome" value="<?php echo $_SESSION["uc"]["nome"]; ?>">
                                            <textarea style="margin:5px;font-size:20px" name="descricao" id="descricao"
                                                class="form-control"><?php echo $_SESSION["uc"]["descricao"]; ?></textarea>

                                            <?php
                                            $sql = "SELECT * from docentes";
                                            $stmt = mysqli_prepare($conn, $sql);

                                            if ($stmt) {
                                                // Execute the statement
                                                mysqli_stmt_execute($stmt);
                                                $result = mysqli_stmt_get_result($stmt);
                                                $docs = array();
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $docs[] = $row;
                                                }

                                                // Close the statement
                                                mysqli_stmt_close($stmt);
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="col-md-1" style="margin:5px;font-size:20px">
                                                    <button type="button" class="btn btn-success" id="addBtn"
                                                        onclick="add()">+</button>
                                                </div>
                                                <div class="col-md-1" style="margin:5px;font-size:20px">
                                                    <input type="text" class="form-control" id="number_docentes"
                                                        value="<?php echo count($nomes) ?>">
                                                </div>
                                                <div class="col-md-1" style="margin:5px;font-size:20px">
                                                    <button type="button" class="btn btn-danger" id="removeBtn"
                                                        onclick="remove()">-</button>
                                                </div>
                                            </div>
                                            <div class="row" id="totalDocentes">
                                                <?php
                                                foreach ($nomes as $nome) {
                                                ?>
                                                    <div class="col-md-4">
                                                        <select style="margin:5px;font-size:20px" class="form-control"
                                                            name="docentes_curso" id="docentes_curso">
                                                            <?php
                                                            foreach ($docs as $doc) {
                                                                if ($doc['id_docente'] == $nome['id_docente']) {
                                                                    echo '<option value="' . $doc['id_docente'] . '" selected>' . $doc["nome"] . '</option>';
                                                                } else {
                                                                    echo '<option value="' . $doc['id_docente'] . '">' . $doc["nome"] . '</option>';
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <input type="hidden" name="docentes_selected" id="docentes_selected" />

                                            <?php
                                            $sql = "SELECT * from cursos";
                                            $stmt = mysqli_prepare($conn, $sql);

                                            if ($stmt) {
                                                // Execute the statement
                                                mysqli_stmt_execute($stmt);
                                                $result = mysqli_stmt_get_result($stmt);
                                                $cursos = array();
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $cursos[] = $row;
                                                }

                                                // Close the statement
                                                mysqli_stmt_close($stmt);
                                            }
                                            ?>
                                            <select style=" margin:5px;font-size:20px" class="form-control" name="curso"
                                                readonly id="curso">
                                                <?php
                                                foreach ($cursos as $curso) {
                                                    if ($curso['id_curso'] == $_SESSION['uc']['Curso']) {
                                                        echo '<option value="' . $curso['id_curso'] . '" selected>' . $curso["nome"] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $curso['id_curso'] . '">' . $curso["nome"] . '</option>';
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
                                                $data = array();
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $data[] = $row;
                                                }

                                                // Close the statement
                                                mysqli_stmt_close($stmt);
                                            }
                                            ?>
                                            <select style=" margin:5px;font-size:20px" class="form-control" name="animacao"
                                                id="animacao">
                                                <?php
                                                foreach ($data as $animacao) {
                                                    if ($animacao['id_animacao'] == $_SESSION['uc']['id_animacao']) {
                                                        echo '<option value="' . $animacao['id_animacao'] . '" selected>' . $animacao["nome"] . '</option>';
                                                    } else {
                                                        echo '<option value="' . $animacao['id_animacao'] . '">' . $animacao["nome"] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <div class="modal fade" id="updateModal" tabindex="-1"
                                                aria-labelledby="updateModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            Atualizar UC <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" id="updateModalBody">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Não</button>
                                                            <button id="updateUC" type="submit"
                                                                class="btn btn-primary">Sim</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <button class="btn btn-primary" id="editButton" onclick="editUC()">Editar</button>
                                    <button type="button" id="updateButton" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#updateModal" onclick="UCedit();setUpdateModalText()"
                                        hidden>Gravar</button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        onclick="setDeleteModalText('<?php echo $_SESSION['uc']['nome']; ?>','<?php echo $_SESSION['uc']['id_uc'] ?>')">Apagar</button>
                                    <?php
                                    if (isset($_SESSION["updated"])) {
                                        echo '<p style="font-size:30px" class="card-text text-success" id="mensagemAtualizada">' . $_SESSION["updated"] . '</p>';
                                    }
                                    if (isset($_SESSION["exists"])) {
                                        echo '<p style="font-size:30px" class="card-text text-danger" id="mensagemAtualizada">' . $_SESSION["exists"] . '</p>';
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>

                    </div>
                <?php
                }
                ?>
                <!-- Begin Page Content -->

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class=" sticky-footer bg-white">
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

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Apagar UC</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="deleteModalBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                    <a id="apagaUC" type="button" class="btn btn-primary">Sim</a>
                </div>
            </div>
        </div>
    </div>

    <select class="form-select" id="foreach_docentes" style="display: none;margin:5px;font-size:20px">
        <option value="">Selecione um docente</option>
        <?php
        foreach ($docentes as $docente) {
            echo '<option value="' . $docente['id_docente'] . '">' . $docente["nome"] . '</option>';
        } ?>
    </select>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
    <script>


    </script>
    <script type="module">
        import {
            objeto
        } from '../js/3D/3D.js';

        const tex = <?= json_encode(base64_encode($_SESSION['uc']['Textura'])) ?>;
        const glb = <?= json_encode(base64_encode($_SESSION['uc']['Objeto'])) ?>;

        try {
            await objeto(tex, glb);
        } catch (e) {
            console.error(e);
            document.getElementById('loading').textContent = 'Failed to load animation.';
        } finally {
            document.body.classList.add('ready');
        }
    </script>
    <?php
    if (isset($_SESSION["uc"])) {
    ?>
        <script>
            let counter = document.getElementById("number_docentes");

            const template = document.getElementById("foreach_docentes");

            const totalDocentes = document.getElementById("totalDocentes");

            const selectedDocentes = document.getElementById("docentes_selected");
            console.log(totalDocentes.children.length);

            function editUC() {
                if (document.getElementById("Editing").hasAttribute("hidden")) {
                    document.getElementById("notEditing").setAttribute("hidden", "");
                    document.getElementById("updateButton").removeAttribute("hidden");
                    document.getElementById("Editing").removeAttribute("hidden");
                    document.getElementById("editButton").setAttribute("hidden", "");
                }
            }

            function add() {
                console.log(selectedDocentes.value);

                counter.value = Number(counter.value) + 1;

                const col = document.createElement('div');
                col.className = 'col-md-4';

                const select = template.cloneNode(true);
                select.setAttribute("id", counter.value);
                select.setAttribute("name", counter.value + "_curso");
                select.style.display = "";

                col.appendChild(select);
                totalDocentes.appendChild(col);
            }

            function remove() {
                if (totalDocentes.children.length > 1) {
                    console.log(totalDocentes.children.length);
                    if (Number(counter.value) > 1) {
                        counter.value = Number(counter.value) - 1;
                        totalDocentes.removeChild(totalDocentes.lastElementChild);
                    }
                }
                console.log(totalDocentes.children.length);
            }

            function setUpdateModalText() {
                var string = "De certeza que quer criar a UC?</br>" +
                    "Campos para a Unidade Curricular</br>" +
                    "Nome: " + document.getElementById("nome").value + "</br>" +
                    "Descrição: " + document.getElementById("descricao").value + "</br>" +
                    "Curso: " + document.getElementById("curso").options[document.getElementById("curso")
                        .selectedIndex].text +
                    "</br>" +
                    "Docentes: " + selectedDocentes.textContent + "</br>" +
                    "Animação: " + document.getElementById("animacao").options[document.getElementById("animacao")
                        .selectedIndex].text;
                document.getElementById("updateModalBody").innerHTML = string;
            }

            function UCedit() {
                selectedDocentes.value = "";
                docentesListBefore = [];
                const selectedNames = [];
                const selects = totalDocentes.querySelectorAll('select[name*="_curso"]');

                selects.forEach(select => {
                    docentesListBefore.push(Number(select.value));
                    name = select.selectedOptions[0]?.text || '';
                    if (name) selectedNames.push(name);
                });

                selectedDocentes.textContent = selectedNames.join(', ');
                selectedDocentes.value = JSON.stringify(docentesListBefore);
                console.log(docentesListBefore);
            }

            function setDeleteModalText(name, id) {
                document.getElementById("deleteModalBody").innerHTML = "De certeza que quer apagar a unidade: \"" + name + "\"";
                document.getElementById("apagaUC").setAttribute("href", "../../database/ucs/delete_uc.php?id=" +
                    id + "&start_page=index");
            }
        </script>
    <?php
    }
    $_SESSION["updated"] = null;
    $_SESSION["exists"] = null;
    ?>
</body>

</html>