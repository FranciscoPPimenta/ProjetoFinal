<?php
session_start();

$_SESSION = [];

session_destroy();

header("Location: ../../admin/login/login.php");
exit;