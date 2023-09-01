<!-- Redirect helper with optional flash message -->
<?php
function redirect($location, $flash=null){
    if($flash){
        $_SESSION["flash_message"] = $flash;
    }
    header("Location: " . $location);
    exit();
}   