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
