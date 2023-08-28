<?php
session_start();
$conn = require_once(__DIR__ . '/../../models/user.php');
require_once(__DIR__ . '/../helpers/cloudinary.php');
require_once(__DIR__ . "/../helpers/auth.php");
require_once(__DIR__ . "/../helpers/redirect.php");

// Block illegal usernames or passwords.
if (strlen($_POST["username"]) < 6 || strlen($_POST["password"]) < 6) {
    redirect("../register", "Username and password must have at least 6 characters.");
// Register new user
} else {
    register($_POST, $conn);
}
