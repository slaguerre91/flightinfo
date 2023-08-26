<?php
function validateAirports($dep, $arr)
{
    // Read the JSON file
    $json = file_get_contents(__dir__ . '/../../views/json/airports.json');
    // Decode the JSON file
    $json_data = json_decode($json, true);
    // Map data
    function airportParser($airport)
    {
        return $airport["name"] . " (" . $airport["city"] . ") - " . $airport["iata_code"];
    }
    $airport_lookup = array_map("airportParser", $json_data);
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
    return empty($_POST["summary"]) || empty($_POST["review_text"]) || empty($_POST["rating"]) || !in_array($_POST["rating"], [1, 2, 3, 4, 5]) || strlen($_POST["summary"]) > 75;
}
