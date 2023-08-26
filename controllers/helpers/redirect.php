<?php
function redirect($location, $flash=null){
    // Redirects to $location with optional flash message
    if($flash){
        $_SESSION["flash_message"] = $flash;
    }
    header("Location: " . $location);
}   