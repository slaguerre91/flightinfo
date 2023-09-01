<!-- Delete review controller -->
<?php
session_start();
require_once(__DIR__ . "/../helpers/redirect.php");
require_once(__dir__ . "/../helpers/validate.php");

if (isset($_SESSION["user"])) {
    deleteReview($_POST);
}
else {
    redirect("../../user/login");
}
