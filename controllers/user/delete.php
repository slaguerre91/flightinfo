<?php
session_start();
$connUser = require_once(__DIR__ . '/../../models/user.php');
$connReviews = require_once(__DIR__ . '/../../models/review.php');
if (isset($_SESSION["id"])) {
    //Delete user account
    $connUser->delete($_SESSION["id"]);
    //Delete user reviews
    $connReviews->deleteUserReviews($_SESSION["id"]);
    require_once("logout.php");
    header("Location: ../../");
} else {
    $_SESSION["flash_message"] = "No logged in user";
    header("Location: ../../views/error");
}
