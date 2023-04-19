<?php
session_start();
$connUser = require_once(__DIR__ . '/../../models/user.php');
$connReviews = require_once(__DIR__ . '/../../models/review.php');
if (isset($_SESSION["id"])) {
    if ($_SESSION["user"] !== "testuser") {
        //Delete user account
        $connUser->delete($_SESSION["id"]);
        //Delete user reviews
        $connReviews->deleteUserReviews($_SESSION["id"]);
        require_once("logout.php");
        header("Location: ../../");
    } else {
        $_SESSION["flash_message"] = "Can't delete the test user!";
        header("Location: ../../error");
    }
} else {
    $_SESSION["flash_message"] = "No logged in user";
    header("Location: ../../error");
}
