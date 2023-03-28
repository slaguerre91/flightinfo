<?php
$conn = require_once('../../models/review.php');
$userConn = require_once('../../models/user.php');
// Check if review Id is valid before loading to view
if (isset($_GET["id"])) {
    $review = $conn->show($_GET["id"]);
    $user = $userConn->show($review["user_id"]);
    if (empty($review)) {
        $_SESSION["flash_message"] = "Review id is empty or does not exit";
        header("Location: index");
    }
} else {
    $_SESSION["flash_message"] = "Please select a review id";
    header("Location: index");
}
