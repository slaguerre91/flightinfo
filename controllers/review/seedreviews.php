<!-- Seed data controller -->
<?php
require_once __DIR__ . '/../../vendor/autoload.php';
$connUser = require_once(__DIR__ . '/../../models/user.php');
require_once(__DIR__ . '/../helpers/airlinepicker.php');
require_once(__DIR__ . '/../helpers/ratingpicker.php');

// Pick 3-10 random airlines
$airlineCount = rand(3, 10);
for ($x = 0; $x < $airlineCount; $x++) {
    $airline = pickAirline();
    // Create 20 - 50 reviews for airline
    $reviewCount = mt_rand(20, 50);
    for ($i = 0; $i < $reviewCount; $i++) {
        // Generate random review data
        $lipsum = new joshtronic\LoremIpsum();
        $fakeReviewSummary =  $lipsum->words(mt_rand(5, 8));
        $fakeReviewText =  $lipsum->paragraphs(mt_rand(1, 5), 'p');
        $user = $connUser->seedRandom();
        $ratingKey = getRandomWeightedElement(array("a" => 5, "b" => 10, "c" => 25, "d" => 35, "e" => 25));
        switch ($ratingKey) {
            case "a":
                $rating = 1;
                break;
            case "b":
                $rating = 2;
                break;
            case "c":
                $rating = 3;
                break;
            case "d":
                $rating = 4;
                break;
            case "e":
                $rating = 5;
                break;
        }
        date_default_timezone_set('UTC');
        $rawTime = mt_rand(time() - 60 * 60 * 24 * 365 * 5, time());
        $timestamp =  date('Y-m-d H:i:s', $rawTime);
        // Create fake review
        $fakeReview = array("dep" => $_GET["dep"], "arr" => $_GET["arr"], "airline" => $airline, "author" => $user["username"], "summary" => $fakeReviewSummary, "review_text" => $fakeReviewText, "rating" => $rating, "id" => $user["id"], "timestamp" => $timestamp);
        $conn->createNew($fakeReview);
    }
}
$searchResults = $conn->search($_GET);
