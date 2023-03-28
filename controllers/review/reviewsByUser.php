<?php
$conn = require_once(__DIR__ . '/../../models/review.php');
$reviews = $conn->getUserReviews($_GET["id"]);
$totalReviews = $conn->getTotalUserReviews($_GET["id"]);
if (empty($totalReviews)) {
    $_SESSION["id"] == $_GET["id"] ? $_SESSION["flash_message"] = "You have no reviews." : $_SESSION["flash_message"] = "User has no reviews or does not exist";
    header("Location: ../../views/");
    exit();
}
