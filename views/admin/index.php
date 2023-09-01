<!-- This page is only accessible to the administrator and is used to seed the users table -->
<?php
session_start();
require_once('../partials/header.php');
require_once(__DIR__ . "/../../controllers/helpers/redirect.php");
if ($_SESSION["user"] !== "administrator") {
    redirect("../user/login");
}
?>
</head>

<body>
    <!-- Display flash message -->
    <?php if (isset($_SESSION["flash_message"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION["flash_message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        unset($_SESSION["flash_message"]);
        ?>
    <?php } ?>

    <?php
    require_once('../partials/nav.php');
    ?>
    <!-- Seed users button -->
    <div class="container">
        <form id="seedusers" class="needs-validation" action="routes/seedusers.php" method="post" novalidate>
            <!-- <input type="hidden" name="count" value="100"> -->
            <button type="submit" class="btn btn-primary">
                submit
            </button>
        </form>
    </div>
    <!-- JQuery --> 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://kit.fontawesome.com/5ea815c1d0.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <!-- Seed users -->
    <script>
        $.ajax({
            url: 'https://randomuser.me/api/?results=100',
            dataType: 'json',
            success: function(data) {
                for (let i = 0; i < 100; i++) {
                    let username = data.results[i].login.username;
                    let password = username;
                    let thumbnail = data.results[i].picture.thumbnail;
                    $("#seedusers").prepend(`<input type='hidden' name='username[]' value=${username}>`);
                    $("#seedusers").prepend(`<input type='hidden' name='password[]' value=${password}>`);
                    $("#seedusers").prepend(`<input type='hidden' name='thumbnail[]' value=${thumbnail}>`);
                }
            }
        });
    </script>
    <?php
    require_once('../partials/footer.php');
    ?>