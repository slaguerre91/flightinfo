<?php
$conn = require_once('../models/review.php');
$recentReviews = $conn->getRecent();
