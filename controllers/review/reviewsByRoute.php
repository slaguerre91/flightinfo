<?php
$conn = require_once('../../models/review.php');
$reviews = $conn->getRouteReviews($_GET);
