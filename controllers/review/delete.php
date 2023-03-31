<?php
session_start();
$conn = require_once('../../models/review.php');
// Authenticate
if (isset($_SESSION["user"])) {
    // Check if review Id is valid before loading to view
    if (isset($_POST["id"])) {
        $review = $conn->show($_POST["id"]);
        if (empty($review)) {
            $_SESSION["flash_message"] = "Unable to perform. Please select a valid post to delete.";
            header("Location: ../../views/error");
            exit();
        }
    } else {
        $_SESSION["flash_message"] = "No review id was provided in post request";
        header("Location: ../../views/error");
        exit();
    }
    // Delete review
    if ($_SESSION["id"] == $review["user_id"]) {
        $conn->delete($_POST["id"]);
        header("Location: ../../views/review/index");
    } else {
        $_SESSION["flash_message"] = "Not allowed. This is not your review.";
        header("Location: ../../views/error");
        exit();
    }
}
// Redirect to login page
else {
    header("Location: ../../views/user/login");
}
