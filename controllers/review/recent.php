<?php
$conn = require_once('../../models/review.php');
$userConn = require_once('../../models/user.php');
$recentReviews = $conn->getRecent();
