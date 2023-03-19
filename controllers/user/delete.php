<?php
session_start();
$connUser = require_once('../../models/user.php');
$connReviews = require_once('../../models/review.php');
if (isset($_SESSION["id"])) {
    //Delete user account
    $connUser->delete($_SESSION["id"]);
    //Delete user reviews
    $connReviews->deleteUserReviews($_SESSION["id"]);
    header("Location: ../user/logout");
} else {
    $_SESSION["flash_message"] = "No logged in user";
    header("Location: ../../views/error");
}
