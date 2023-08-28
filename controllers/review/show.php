<?php
require_once(__DIR__ . "/../helpers/redirect.php");

$conn = require_once('../../models/review.php');
$userConn = require_once('../../models/user.php');
// Check if review Id is valid before loading to view
if (isset($_GET["id"])) {
    $review = $conn->show($_GET["id"]);
    $user = $userConn->show($review["user_id"]);
    if (empty($review)) {
        redirect("../error", "Review id is empty or does not exist");
    }
} else {
    redirect("../error", "Please select a review id");
}
