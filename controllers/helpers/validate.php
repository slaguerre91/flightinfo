<!-- Validation helpers for controllers -->
<?php
function validateAirports($dep, $arr)
{
    // Read the JSON file
    $json = file_get_contents(__dir__ . '/../../views/json/airports.json');
    // Decode the JSON file
    $json_data = json_decode($json, true);
    // Parse and map data
    function airportParser($airport)
    {
        return $airport["name"] . " (" . $airport["city"] . ") - " . $airport["iata_code"];
    }
    $airport_lookup = array_map("airportParser", $json_data);
    // Return true if paramaters are valid airport names
    return in_array($dep, $airport_lookup) && in_array($arr, $airport_lookup) && strcmp($dep, $arr) !== 0;
}

function validateAirline($airlineInput)
{
    // Read the JSON file
    $json = file_get_contents(__dir__ . '/../../views/json/airlines.json');
    // Decode the JSON file
    $json_data = json_decode($json, true);
    // Map data
    function airlineParser($airline)
    {
        return $airline["name"];
    }
    $airline_lookup = array_map("airlineParser", $json_data);
    return in_array($airlineInput, $airline_lookup);
}

function invalidNewPost($post){
    // Returns true if user attempts to create a post with invalid values
    return empty($post["dep"]) || empty($post["arr"]) || !validateAirports($post["dep"], $post["arr"]) || empty($post["airline"]) || !validateAirline($post["airline"]) ||
        empty($post["summary"]) || empty($post["review_text"]) || empty($post["rating"]) || !in_array($post["rating"], [1, 2, 3, 4, 5])
        || strlen($post["summary"]) > 75 || (int)$post["id"] !== $_SESSION["id"] || $post["author"] !== $_SESSION["user"];
}

function invalidUpdatedPost($post){
    // Returns true if user attempts to update a post with invalid values
    return empty($post["summary"]) || empty($post["review_text"]) || empty($post["rating"]) || !in_array($post["rating"], [1, 2, 3, 4, 5]) || strlen($post["summary"]) > 75;
}


function invalidSearch($get){
    // Returns true if user attempts an invalid search
    return  empty($get["dep"]) || empty($get["arr"]) || !validateAirports($get["dep"], $get["arr"]);
}

function updateReview($userReview, $reviewModel){
    // Check if review Id is valid before querying database
    if (isset($userReview["id"])) {
        $review = $reviewModel->show($userReview["id"]);
        if (empty($review)) {
            redirect("../../error", "Review id is empty or does not exist");
        }
    } else {
        redirect("../../error", "No review id was provided in post request");
    }
    // Check for other empty or invalid input fields
    if (invalidUpdatedPost($userReview)) {
        redirect("../../error", "Invalid input data.");
    }
    // Update review
    if ($_SESSION["id"] == $review["user_id"]) {
        $reviewModel->update($userReview);
        redirect("../show?id=" . $userReview["id"]);
    } else {
        redirect( "../../error", "You can only update your own post.");
    }
}

function createReview($userReview){
    // Check for empty or invalid fields
    if (invalidNewPost($userReview)) {
        redirect("../create", "Invalid input data.");
    }
    // Create review
    $conn = require_once(__DIR__ . "/../../models/review.php");
    $conn->createNew($userReview);
    redirect("../../");
}

function deleteReview($userReview){
    $conn = require_once(__DIR__ . '/../../models/review.php');
    // Check if review Id is valid before querying database
    if (isset($userReview["id"])) {
        $review = $conn->show($userReview["id"]);
        if (empty($review)) {
            redirect("../../error", "Unable to perform. Please select a valid post to delete." );
        }
    } else {
        redirect("../../error", "No review id was provided in post request");
    }
    // Delete review
    if ($_SESSION["id"] == $review["user_id"]) {
        $conn->delete($userReview["id"]);
        redirect("../../");
    } else {
        redirect("../../error",  "Not allowed. This is not your review.");
    }
}