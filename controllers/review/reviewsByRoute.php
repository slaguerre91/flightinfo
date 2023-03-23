<?php
$conn = require_once('../../models/review.php');
$reviews = $conn->getRouteReviews($_GET);
$totalReviews = $conn->getTotalRouteReviews($_GET);
if (empty($reviews)) {
    $_SESSION["flash_message"] = "Invalid Input data.";
    header("Location: ../../views/error");
    exit();
}
