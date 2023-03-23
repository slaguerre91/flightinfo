<?php
session_start();
$conn = require_once('../../models/user.php');
require_once(__DIR__ . '/../helpers/cloudinary.php');

// Block illegal usernames or passwords.
if (strlen($_POST["username"]) < 6 || strlen($_POST["password"]) < 6) {
    header("Location: ../../views/user/register");
} else {
    $register = $conn->register($_POST);
    $upload = uploadThumbnail();
    if ($register == "User already exists") {
        $_SESSION["flash_message"] = $register;
        header("Location: ../../views/user/register");
        exit;
    }
    if (strcmp($upload, "Success") != 0) {
        $_SESSION["flash_message"] = $upload;
        header("Location: ../../views/user/register");
        $conn->delete($register["Id"]);
        exit;
    }
    // upload profile picture to Cloudinary and redirect to index
    $_SESSION["user"] = $register["username"];
    $_SESSION["id"] = $register["Id"];
    $_SESSION["flash_message"] = "Welcome, " . $_SESSION["user"];
    header("Location: ../../views/index");
}
