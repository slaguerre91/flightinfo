<?php
session_start();
require_once("../helpers/validate.php");
$conn = require_once('../../models/review.php');
// Authenticate
if (isset($_SESSION["user"])) {
    // Check if review Id is valid before loading to view
    if (isset($_POST["id"])) {
        $review = $conn->show($_POST["id"]);
        if (empty($review)) {
            echo "Review id " . $_POST["id"] . " is empty or does not exist";
            exit;
        }
    } else {
        $_SESSION["flash_message"] = "No review id was provided in post request";
        header("Location: ../../views/index");
        exit;
    }
    // Check for other empty or invalid input fields
    if (
        empty($_POST["dep"]) || empty($_POST["arr"]) || !validateAirports($_POST["dep"], $_POST["arr"]) || empty($_POST["airline"]) || !validateAirline($_POST["airline"]) ||
        empty($_POST["review_text"]) || empty($_POST["rating"]) || !in_array($_POST["rating"], [1, 2, 3, 4, 5]) || strlen($_POST["review_text"]) < 5
    ) {
        echo "Invalid input data.";
        $_SESSION["flash_message"] = "Invalid input data.";
        header("Location: ../../views/index");
        exit();
    }
    // Update review
    if ($_SESSION["id"] == $review["user_id"]) {
        $conn->update($_POST);
        header("Location: ../../views/review/show?id=" . $_POST["id"]);
    } else {
        echo "You can only update your own post.";
        exit;
    }
}
// Redirect to login page
else {
    header("Location: ../../views/user/login");
}
