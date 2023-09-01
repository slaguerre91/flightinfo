<?php

require __DIR__ . '/../../vendor/autoload.php';
// Use the Configuration class 
use Cloudinary\Configuration\Configuration;
// Use the UploadApi class for uploading assets
use Cloudinary\Api\Upload\UploadApi;
// Use the AdminApi class for downloading asset info
use Cloudinary\Api\Admin\AdminApi;
use Dotenv\Dotenv;
//Configure Cloudinary ENV variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();
Configuration::instance("cloudinary://" . $_ENV["CLOUDINARY_API_KEY"] . ":" . $_ENV["CLOUDINARY_API_SECRET"] . "@" .  $_ENV["CLOUDINARY_CLOUD_NAME"] . "?secure=true");

function uploadThumbnail()
{
    /* ----------- File upload ---------- */
    $allowed_ext = array('png', 'jpg', 'jpeg', 'gif');
    if (isset($_POST['submit'])) {
        // Check if file was uploaded
        if (!empty($_FILES['thumbnail']['name'])) {
            $file_name = $_FILES['thumbnail']['name'];
            $file_size = $_FILES['thumbnail']['size'];
            $file_tmp = $_FILES['thumbnail']['tmp_name'];
            $target_dir = "uploads/" . $file_name;
            // Get file extension
            $file_ext = explode('.', $file_name);
            $file_ext = strtolower(end($file_ext));
            // echo $file_ext;

            // Validate file type/extension
            if (in_array($file_ext, $allowed_ext)) {
                // Validate file size
                if ($file_size <= 1000000) { // 1000000 bytes = 1MB
                    // Upload file
                    // move_uploaded_file($file_tmp, $target_dir);
                    (new UploadApi())->upload($_FILES['thumbnail']['tmp_name'], [
                        'public_id' => $_POST["username"],
                        'folder' => 'user_thumbnails',
                        'use_filename' => TRUE,
                        'overwrite' => TRUE,
                        "width" => 50, "height" => 50
                    ]);
                } else {
                    $message =  'File too large!';
                }
            } else {
                $message = 'Invalid file type!';
            }
        } else {
            $message = 'Please choose a file';
        }
    }
    if (isset($message)) {
        return $message;
    } else {
        return "Success";
    }
}

function uploadSeedThumbnail($url, $username)
{
    // Upload seed files
    (new UploadApi())->upload($url, [
        'public_id' => $username,
        'folder' => 'user_thumbnails',
        'use_filename' => TRUE,
        'overwrite' => TRUE
    ]);
}
function getURL($username)
{
    // Get the asset details
    $admin = new AdminApi();
    $url = (stripslashes(
        json_encode(
            $admin->asset("user_thumbnails/" . $username, [
                'colors' => TRUE
            ])["url"],
            JSON_PRETTY_PRINT
        )
    ));
    $url = trim($url, '"');
    return $url;
}
