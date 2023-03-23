<?php
$conn = require_once(__DIR__ . '/../../models/review.php');
$reviews = $conn->getUserReviews($_GET["id"]);
$totalReviews = $conn->getTotalUserReviews($_GET["id"]);
