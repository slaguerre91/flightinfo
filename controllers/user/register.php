<?php
session_start();
$conn = require_once('../../models/user.php');
// Block illegal usernames or passwords.
if (strlen($_POST["username"]) < 6 || strlen($_POST["password"]) < 6) {
    header("Location: ../../views/user/register");
} else {
    $register = $conn->register($_POST);
    if ($register == "User already exists") {
        $_SESSION["flash_message"] = $register;
        header("Location: ../../views/user/register");
    } else {
        $_SESSION["user"] = $register["username"];
        $_SESSION["id"] = $register["Id"];
        $_SESSION["flash_message"] = "Welcome, " . $_SESSION["user"];
        header("Location: ../../views/index");
    }
}
