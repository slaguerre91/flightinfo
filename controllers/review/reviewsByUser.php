<?php
require_once(__DIR__ . "/../helpers/redirect.php");

$conn = require_once(__DIR__ . '/../../models/review.php');
$reviews = $conn->getUserReviews($_GET["id"]);
$totalReviews = $conn->getTotalUserReviews($_GET["id"]);
if (empty($reviews)) {
    redirect("../error", "User has no reviews or does not exist");
}
