<?php
require_once __DIR__ . "\..\..\database\config.php";
session_start();
if (isset($_SESSION["admin"])) {
    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProjetoFinal</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
</head>

<body>

    <div class="container">
        <form action="../../database/admin/login.php" method="POST">
            <div class="row">
                <div class="col-md-12">
                    <label for="admin_name">Admin Username</label>
                    <input type="text" class="form-control" name="admin_name" placeholder="Admin Username" required>
                </div>
            </div>
            <div class="row passworD">
                <div class="col-md-12">
                    <label for="admin_password">Password</label>
                    <input type="password" class="form-control" name="admin_password" placeholder="Password" required>
                </div>
            </div>
            <div class="row justify-content-center" text-center>
                <button id="login" type="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="row" text-center>
                <?php
                if (isset($_SESSION["exists"])) {
                    echo '<p class="fs-4 text-' . $_SESSION["color"] . '">' . $_SESSION["exists"] . '</p>';
                    $_SESSION["exists"] = null;
                }
                ?>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>