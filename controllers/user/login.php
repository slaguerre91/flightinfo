<?php
session_start();
$conn = require_once(__DIR__ . '/../../models/user.php');
$login = $conn->login($_POST);
if ($login == "login failed") {
    $_SESSION["flash_message"] = "Invalid username or password.";
    header("Location: ../login");
} else {
    $_SESSION["user"] = $login["username"];
    $_SESSION["id"] = $login["id"];
    if (isset($_SESSION["currUrl"])) {
        $currUrl = $_SESSION["currUrl"];
        unset($_SESSION["currUrl"]);
        header("Location: ../../" . $currUrl);
    } else {
        $_SESSION["flash_message"] = "Welcome back, " . $_SESSION["user"];
        header("Location: ../../");
    }
}
