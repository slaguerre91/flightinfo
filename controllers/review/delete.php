<?php
$conn = require_once('../../models/review.php');
session_start();
// Authenticate
if (isset($_SESSION["user"])) {
    // Check if review Id is valid before loading to view
    if (isset($_POST["id"])) {
        $review = $conn->show($_POST["id"]);
        if (empty($review)) {
            $_SESSION["flash_message"] = "Unable to perform. Please select a valid post to delete.";
            header("Location: ../../views/error.php");
            exit();
        }
    } else {
        $_SESSION["flash_message"] = "No review id was provided in post request";
        header("Location: ../../views/error.php");
        exit();
    }
    // Delete review
    if ($_SESSION["id"] == $review["user_id"]) {
        $conn->delete($_POST["id"]);
        header("Location: ../../views/index.php");
    } else {
        $_SESSION["flash_message"] = "Not allowed. This is not your review.";
        header("Location: ../../views/error.php");
        exit();
    }
}
// Redirect to login page
else {
    // header("Location: ../../views/user/login.php?id=" . $_POST["id"]);
    header("Location: ../../views/user/login.php");
}
