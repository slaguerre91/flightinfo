<?php
function getLogo($airline)
{
    // Read the JSON file
    $json = file_get_contents(__DIR__ . '/../../views/json/airlines.json');
    // Decode the JSON file
    $json_data = json_decode($json, true);
    $index = array_search($airline, array_column($json_data, "name"));
    $logo = $json_data[$index]["logo"];
    return $logo;
}
