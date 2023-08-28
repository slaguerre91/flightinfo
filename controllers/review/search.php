<?php
require_once(__DIR__ . "/../helpers/validate.php");
require_once(__DIR__ . "/../helpers/airlinelogo.php");
require_once(__DIR__ . "/../helpers/redirect.php");

if (invalidSearch($_GET)) {
    redirect("../", "Invalid search criteria.");
}
$conn = require_once('../../models/review.php');
$searchResults = $conn->search($_GET);
//Create fake reviews if $reviews is empty
if (count($searchResults) < 2) {
    require_once('seedreviews.php');
}
