<?php
$conn = require_once('../../models/review.php');
$reviews = $conn->getUserReviews($_GET["id"]);
