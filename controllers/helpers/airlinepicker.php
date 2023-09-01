<!-- Pick a random airline for database seeding purposes --> 
<?php
function pickAirline()
{
    // Read the JSON file
    $json = file_get_contents(__DIR__ . '/../../views/json/airlines.json');
    // Decode and parse the JSON file
    $json_data = json_decode($json, true);
    $airline = $json_data[rand(0, count($json_data))]["name"];
    // Return airline name
    return $airline;
}
