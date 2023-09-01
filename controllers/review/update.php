<!-- Update review controller -->
<?php
session_start();
require_once(__DIR__ . "/../helpers/validate.php");
require_once(__DIR__ . "/../helpers/redirect.php");

$conn = require_once(__DIR__ . '/../../models/review.php');
// Update review if validated
if (isset($_SESSION["user"])) {
    updateReview($_POST, $conn);
}
// Redirect to login page
else {
    redirect("../../user/login");
}
