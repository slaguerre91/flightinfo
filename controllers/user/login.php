<?php
session_start();
$conn = require_once('../../models/user.php');
$login = $conn->login($_POST);
if ($login == "login failed") {
    $_SESSION["flash_message"] = "Invalid username or password.";
    header("Location: ../../views/user/login");
} else {
    $_SESSION["user"] = $login["username"];
    $_SESSION["id"] = $login["Id"];
    if (isset($_SESSION["currUrl"])) {
        $currUrl = $_SESSION["currUrl"];
        unset($_SESSION["currUrl"]);
        header("Location: " . "../../views/" . $currUrl);
    } else {
        $_SESSION["flash_message"] = "Welcome back, " . $_SESSION["user"];
        header("Location: ../../views/review/index");
    }
}
