<!-- Creates 100 users using randomuser.me API calls -->
<?php
require_once(__DIR__ . "/../helpers/cloudinary.php");
session_start();
if (isset($_SESSION["user"]) && $_SESSION["user"] == "administrator") {
    $conn = require_once('../../models/user.php');
    // Save seed users to db
    $conn->seedUsers($_POST);
    //Upload seed thumbnails to cloudinary
    for ($i = 0; $i < count($_POST["username"]); $i++) {
        uploadSeedThumbnail($_POST["thumbnail"][$i], $_POST["username"][$i]);
    }
    header("Location: " . "../../views/");
} else {
    header("Location: ../../views/user/login");
}
