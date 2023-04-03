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
        <form action="routes/delete.php" method="post">
            <input type="hidden" name="id" value=<?php echo $_SESSION["id"] ?>>
            <button class="btn btn-danger">Close Account</button>
        </form>
    </div>
    <?php
    require_once('../partials/footer.php');
    ?>
</body>

</html>