<?php
function login($username, $id){
    $_SESSION["user"] = $username;
    $_SESSION["id"] = $id;
    if (isset($_SESSION["currUrl"])) {
        $currUrl = $_SESSION["currUrl"];
        unset($_SESSION["currUrl"]);
        redirect("../../" . $currUrl);
    } else {
        redirect("../../", "Welcome back, " . $_SESSION["user"]);
    }
}

function logout(){
    unset($_SESSION['user']);
    unset($_SESSION['id']);
    redirect("../../", "Goodbye");
}

function register($credentials, $userModel){
    $register = $userModel->register($credentials);
    $upload = uploadThumbnail();
    if ($register == "User already exists") {
        redirect("../register", $register);
    }
    if (strcmp($upload, "Success") != 0) {
        redirect("../register", $upload);
        $userModel->delete($register["id"]);
    }
    
    // upload profile picture to Cloudinary and redirect to index
    $_SESSION["user"] = $register["username"];
    $_SESSION["id"] = $register["id"];
    $_SESSION["flash_message"] = "Welcome, " . $_SESSION["user"];
    redirect("../../");
}