<!-- Delete user controller -->
<?php
session_start();
require_once(__DIR__ . "/../helpers/redirect.php");

$connUser = require_once(__DIR__ . '/../../models/user.php');
$connReviews = require_once(__DIR__ . '/../../models/review.php');
if (isset($_SESSION["id"])) {
    if ($_SESSION["user"] !== "testuser") {
        //Delete user account
        $connUser->delete($_SESSION["id"]);
        //Delete user reviews
        $connReviews->deleteUserReviews($_SESSION["id"]);
        require_once("logout.php");
        redirect("../../");
    } else {
        redirect("../../error", "Can't delete the test user!");
    }
} else {
    redirect("../../error", "No logged in user");
}
