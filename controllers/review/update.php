<?php
session_start();
require_once(__DIR__ . "/../helpers/validate.php");
require_once(__DIR__ . "/../helpers/redirect.php");

$conn = require_once(__DIR__ . '/../../models/review.php');
// Authenticate
if (isset($_SESSION["user"])) {
    // Check if review Id is valid before loading to view
    if (isset($_POST["id"])) {
        $review = $conn->show($_POST["id"]);
        if (empty($review)) {
            redirect("../", "Review id " . $_POST["id"] . " is empty or does not exist");
            // $_SESSION["flash_message"] = "Review id " . $_POST["id"] . " is empty or does not exist";
            // header("Location: ../");
             exit();
        }
    } else {
        redirect("../../", "No review id was provided in post request");
        // $_SESSION["flash_message"] = "No review id was provided in post request";
        // header("Location: ../../");
         exit();
    }
    // Check for other empty or invalid input fields
    if (invalidUpdatedPost($_POST)) {
        redirect("../../", "Invalid input data.");
        // $_SESSION["flash_message"] = "Invalid input data.";
        // header("Location: ../../");
        exit();
    }
    // Update review
    if ($_SESSION["id"] == $review["user_id"]) {
        $conn->update($_POST);
        redirect("../show?id=" . $_POST["id"]);
        // header("Location: ../show?id=" . $_POST["id"]);
    } else {
        redirect( "../../", "You can only update your own post!");
        // $_SESSION["flash_message"] = "You can only update your own post.";
        // header("Location: ../../");
        exit();
    }
}
// Redirect to login page
else {
    redirect("../../user/login");
}
