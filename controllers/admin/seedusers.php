<!-- Creates 100 users using randomuser.me API calls -->
<?php
session_start();
$conn = require_once('../../models/user.php');
$conn->seedUsers($_POST);
