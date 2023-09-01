<!-- Create review page -->
<?php
session_start();
require_once(__DIR__ . "/../../controllers/helpers/redirect.php");

//Redirect to login page if user is not logged authenticated.
if (!isset($_SESSION['user'])) {
    $_SESSION["currUrl"] = "review/" . substr(basename(__FILE__), 0, -4);
    redirect("../user/login", "You need to be logged in to perform this operation");
}
require_once('../partials/header.php');
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>

<body>
    <?php
    require_once('../partials/nav.php');
    // Display flash message
    if (isset($_SESSION["flash_message"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION["flash_message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        unset($_SESSION["flash_message"]);
        ?>
    <?php } ?>
    <!-- Main page content -->
    <div class="container">
        <form class="needs-validation" action="routes/create.php" method="post" novalidate>
            <div class="form-group">
                <input type="hidden" name="author" value="<?php echo $_SESSION["user"] ?>">
                <input type="hidden" name="id" value="<?php echo $_SESSION["id"] ?>">
                <input type="text" class="form-control my-2" name="dep" id="dep" placeholder="Origin" aria-label="origin" required>
                <div class="invalid-feedback">
                    Field can't be empty
                </div>
                <input type="text" class="form-control my-2" name="arr" id="arr" placeholder="Destination" aria-label="destination" required>
                <div class="invalid-feedback">
                    Field can't be empty
                </div>
                <input type="text" class="form-control my-2" name="airline" id="airline" placeholder="Airline" aria-label="airline" required>
                <div class="invalid-feedback">
                    Field can't be empty
                </div>
                <div class="mb-3">
                    <textarea class="form-control my-2" name="summary" id="summary" rows="3" placeholder="Summary" aria-label="summary" maxlength="75" required></textarea>
                    <small class="form-text text-muted">0 characters remaining</small>
                    <div class="invalid-feedback">
                        Field can't be empty
                    </div>
                </div>
                <div class="mb-3">
                    <textarea class="form-control my-2" name="review_text" id="review" rows="3" placeholder="Your review" aria-label="review" required></textarea>
                    <div class="invalid-feedback">
                        Field can't be empty
                    </div>
                </div>
                <div class="star-rating">
                    <input type="radio" class="form-control" name="rating" id="star-a" value="5" required>
                    <label for="star-a"></label>
                    <input type="radio" name="rating" id="star-b" value="4" required>
                    <label for="star-b"></label>

                    <input type="radio" name="rating" id="star-c" value="3" required>
                    <label for="star-c"></label>

                    <input type="radio" name="rating" id="star-d" value="2" required>
                    <label for="star-d"></label>

                    <input type="radio" name="rating" id="star-e" value="1" required>
                    <label for="star-e"></label>
                </div>
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="../js/scripts.js"></script>
<?php
require_once('../partials/footer.php');
?>