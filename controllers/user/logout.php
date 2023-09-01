<!-- Logout controller -->
<?php
session_start();
require_once(__DIR__ . "/../helpers/redirect.php");
require_once(__DIR__ . "/../helpers/auth.php");

if (isset($_SESSION['user'])) {
    logout();
} else {
    redirect("../../error", "Unable to perform. No user detected.");
}
