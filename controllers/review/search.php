<?php
$conn = require_once('../../models/review.php');
$searchResults = $conn->search($_GET);
//Create fake reviews if $reviews is empty
if (count($searchResults) < 2) {
    require_once('seedreviews.php');
}
