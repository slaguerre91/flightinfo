<?php
require_once(__DIR__ . "/../helpers/redirect.php");

$conn = require_once('../../models/review.php');
$reviews = $conn->getRouteReviews($_GET);
$totalReviews = $conn->getTotalRouteReviews($_GET);
if (empty($reviews) || empty($totalReviews)) {
    redirect("../error", "Invalid Request");
}
