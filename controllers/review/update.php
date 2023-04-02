<?php
session_start();
require_once(__DIR__ . "/../helpers/validate.php");
$conn = require_once(__DIR__ . '/../../models/review.php');
// Authenticate
if (isset($_SESSION["user"])) {
    // Check if review Id is valid before loading to view
    if (isset($_POST["id"])) {
        $review = $conn->show($_POST["id"]);
        if (empty($review)) {
            $_SESSION["flash_message"] = "Review id " . $_POST["id"] . " is empty or does not exist";
            header("Location: ../");
            exit;
        }
    } else {
        $_SESSION["flash_message"] = "No review id was provided in post request";
        header("Location: ../../");
        exit;
    }
    // Check for other empty or invalid input fields
    if (
        empty($_POST["summary"]) || empty($_POST["review_text"]) || empty($_POST["rating"]) || !in_array($_POST["rating"], [1, 2, 3, 4, 5]) || strlen($_POST["summary"]) > 75
    ) {
        $_SESSION["flash_message"] = "Invalid input data.";
        header("Location: ../../");
        exit();
    }
    // Update review
    if ($_SESSION["id"] == $review["user_id"]) {
        $conn->update($_POST);
        header("Location: ../show?id=" . $_POST["id"]);
    } else {
        $_SESSION["flash_message"] = "You can only update your own post.";
        header("Location: ../../");
        exit;
    }
}
// Redirect to login page
else {
    header("Location: ../../user/login");
}
