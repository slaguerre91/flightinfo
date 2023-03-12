<?php
$conn = require_once('../../models/review.php');
// Check if review Id is valid before loading to view
if (isset($_GET["id"])) {
    $review = $conn->show($_GET["id"]);
    if (empty($review)) {
        $_SESSION["flash_message"] = "Review id is empty or does not exit";
        header("Location: error.php");
    }
} else {
    $_SESSION["flash_message"] = "Please select a review id";
    header("Location: error.php");
}
