<?php
$conn = require_once('../../models/review.php');
$reviews = $conn->getRouteReviews($_GET);
$totalReviews = $conn->getTotalRouteReviews($_GET);
if (empty($reviews) || empty($totalReviews)) {
    $_SESSION["flash_message"] = "Invalid Request";
    header("Location: ../../views/");
    exit();
}
