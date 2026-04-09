<?php
require_once '../config.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["admin_name"];
    $password = $_POST["admin_password"];

    $sql = "SELECT * FROM admin WHERE admin_name = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "s", $user);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo $row["admin_pass"];
            echo '<br>';
            echo password_hash($password, PASSWORD_DEFAULT);
            if (password_verify($password, $row["admin_pass"])) {
                var_dump(password_verify($password, $row["admin_pass"]));
                $_SESSION["admin"] = $row["id_admin"];
                header("Location: ../../admin/index.php");
                exit();
            } else {
                $_SESSION["exists"] = "Nome Admin ou Password incorreta!";
                $_SESSION["color"] = "danger";
                header("Location: ../../admin/login/login.php");
                exit();
            }
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(array("error" => "Failed to prepare SQL statement."));
    }
} else {

    echo "Please submit the form.";
}


mysqli_close($conn);
