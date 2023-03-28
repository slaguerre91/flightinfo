<?php
session_start();
require_once("../helpers/validate.php");
if (isset($_SESSION["user"])) {
    // Check for empty or invalid fields
    if (
        empty($_POST["dep"]) || empty($_POST["arr"]) || !validateAirports($_POST["dep"], $_POST["arr"]) || empty($_POST["airline"]) || !validateAirline($_POST["airline"]) ||
        empty($_POST["summary"]) || empty($_POST["review_text"]) || empty($_POST["rating"]) || !in_array($_POST["rating"], [1, 2, 3, 4, 5])
        || strlen($_POST["summary"]) > 75
    ) {
        $_SESSION["flash_message"] = "Invalid input data.";
        header("Location: ../../views/review/create");
        exit();
    }
    // Create review
    $conn = require_once('../../models/review.php');
    $conn->createNew($_POST);
    header("Location: ../../views/index");
} else {
    header("Location: ../../views/user/login");
}
