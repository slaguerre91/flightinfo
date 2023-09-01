<!-- Helpers for auth controllers --> 

<?php
function login($username, $id){
    // Start session
    $_SESSION["user"] = $username;
    $_SESSION["id"] = $id;
    // Redirect to origin ($_SESSION["currUrl"]) url after login
    if (isset($_SESSION["currUrl"])) {
        $currUrl = $_SESSION["currUrl"];
        unset($_SESSION["currUrl"]);
        redirect("../../" . $currUrl);
    // Redirect to homepage
    } else {
        redirect("../../", "Welcome back, " . $_SESSION["user"]);
    }
}

function logout(){
    // End session
    unset($_SESSION['user']);
    unset($_SESSION['id']);
    // Redirect to homepage
    redirect("../../", "Goodbye");
}

function register($credentials, $userModel){
    // Register new user
    $register = $userModel->register($credentials);
    // Upload user thumbnail
    $upload = uploadThumbnail();
    // Redirect to register page (failed attempt)
    if ($register == "User already exists") {
        redirect("../register", $register);
    }
    // Redirect to register page (Couldn't upload thumbnail)
    if (strcmp($upload, "Success") != 0) {
        redirect("../register", $upload);
        $userModel->delete($register["id"]);
    }
    // Start session (successful registration)
    $_SESSION["user"] = $register["username"];
    $_SESSION["id"] = $register["id"];
    redirect("../../",  "Welcome, " . $_SESSION["user"]);
}