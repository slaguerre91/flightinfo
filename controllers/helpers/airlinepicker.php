<?php
function pickAirline()
{
    // Read the JSON file
    $json = file_get_contents(__DIR__ . '/../../views/json/airlines.json');
    // Decode the JSON file
    $json_data = json_decode($json, true);
    $airline = $json_data[rand(0, count($json_data))]["name"];
    return $airline;
}
