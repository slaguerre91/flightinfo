<?php
session_start();
require_once('../partials/header.php');
//Redirect to login page if user is not logged authenticated.
if (!isset($_SESSION['user'])) {
    $_SESSION["currUrl"] = "user/" . basename(__FILE__);
    header("Location: login.php");
    exit;
}
?>
</head>

<body>
    <?php
    require_once('../partials/nav.php');
    ?>
    <div class="container">
        <h1>
            <?php
            echo $_SESSION["user"];
            ?>
        </h1>
        <a href="routes/delete.php">Close Account</a>
    </div>
    <?php
    require_once('../partials/footer.php');
    ?>
</body>

</html>