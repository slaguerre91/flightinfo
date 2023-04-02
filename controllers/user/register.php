<?php
session_start();
$conn = require_once(__DIR__ . '/../../models/user.php');
require_once(__DIR__ . '/../helpers/cloudinary.php');

// Block illegal usernames or passwords.
if (strlen($_POST["username"]) < 6 || strlen($_POST["password"]) < 6) {
    header("Location: ../register");
} else {
    $register = $conn->register($_POST);
    $upload = uploadThumbnail();
    if ($register == "User already exists") {
        $_SESSION["flash_message"] = $register;
        header("Location: ../register");
        exit;
    }
    if (strcmp($upload, "Success") != 0) {
        $_SESSION["flash_message"] = $upload;
        header("Location: ../register");
        $conn->delete($register["id"]);
        exit;
    }
    // upload profile picture to Cloudinary and redirect to index
    $_SESSION["user"] = $register["username"];
    $_SESSION["id"] = $register["id"];
    $_SESSION["flash_message"] = "Welcome, " . $_SESSION["user"];
    header("Location: ../../");
}
