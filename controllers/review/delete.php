<?php
session_start();
require_once(__DIR__ . "/../helpers/redirect.php");
require_once(__dir__ . "/../helpers/validate.php");

// Delete review if validated
if (isset($_SESSION["user"])) {
    deleteReview($_POST);
}
// Redirect to login page
else {
    redirect("../../user/login");
}
