<?php
$conn = require_once('../../models/review.php');
$reviews = $conn->getRouteReviews($_GET);
$totalReviews = $conn->getTotalRouteReviews($_GET);
if (empty($reviews)) {
    $_SESSION["flash_message"] = "Invalid route data.";
    header("Location: ../../views/index");
    exit();
}
