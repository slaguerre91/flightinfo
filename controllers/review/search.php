<?php
require_once(__DIR__ . "/../helpers/validate.php");
require_once(__DIR__ . "/../helpers/airlinelogo.php");


if (
    empty($_GET["dep"]) || empty($_GET["arr"]) || !validateAirports($_GET["dep"], $_GET["arr"])
) {
    $_SESSION["flash_message"] = "Invalid search criteria.";
    header("Location: ../../views/review/index");
    exit();
}
$conn = require_once('../../models/review.php');
$searchResults = $conn->search($_GET);
//Create fake reviews if $reviews is empty
if (count($searchResults) < 2) {
    require_once('seedreviews.php');
}
