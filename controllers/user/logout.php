<?php
session_start();
if (isset($_SESSION['user'])) {
    unset($_SESSION['user']);
    unset($_SESSION['id']);
    $_SESSION["flash_message"] = "Goodbye";
    header("Location: ../../views/review/index");
} else {
    $_SESSION["flash_message"] = "Unable to perform. No user detected.";
    header("Location: ../../views/error");
}
