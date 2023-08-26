<?php
session_start();
require_once(__dir__ . "/../helpers/validate.php");
if (isset($_SESSION["user"])) {
    // Check for empty or invalid fields
    if (invalidNewPost($_POST)) {
        $_SESSION["flash_message"] = "Invalid input data.";
        header("Location: ../create");
        exit();
    }
    // Create review
    $conn = require_once(__DIR__ . "/../../models/review.php");
    $conn->createNew($_POST);
    header("Location: ../../");
} else {
    header("Location: ../../user/login");
}
