<!-- Login controller -->
<?php
session_start();
require_once(__DIR__ . "/../helpers/redirect.php");
require_once(__DIR__ . "/../helpers/auth.php");

$conn = require_once(__DIR__ . '/../../models/user.php');
$login = $conn->login($_POST);
if ($login == "login failed") {
    redirect("../login", "Invalid username or password.");
} else {
    login($login["username"], $login["id"]);
}
