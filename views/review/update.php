<?php
session_start();
require_once('../partials/header.php');
require_once('../../controllers/review/show.php');
//Redirect to login page if user is not authenticated.
if (!isset($_SESSION['user'])) {
    $_SESSION["currUrl"] = "review/" . basename(__FILE__) . "?id=" . $_GET["id"];
    header("Location: ../user/login.php");
    exit;
}
// Restrict access to page if post does not belong to user
if ($_SESSION["id"] !== $review["user_id"]) {
    $_SESSION["flash_message"] = "You can only update your own post.";
    header("Location: ../index.php");
    exit;
}
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>

<body>
    <?php
    require_once('../partials/nav.php');
    ?>
    <div class="container">
        <form class="needs-validation" action=" ../../controllers/review/update.php" method="post" novalidate>
            <div class="form-group">
                <input type="hidden" name="id" value="<?php echo $review["id"] ?>">
                <label for="dep">Departure Airport</label>
                <input type="text" class="form-control" name="dep" id="dep" value="<?php echo $review["dep"] ?>" required>
                <div class="invalid-feedback">
                    Field can't be empty
                </div>
                <label for="arr">Arrival Airport</label>
                <input type="text" class="form-control" name="arr" id="arr" value="<?php echo $review["arr"] ?>" required>
                <div class="invalid-feedback">
                    Field can't be empty
                </div>
                <label for="airline">Airline</label>
                <input type="text" class="form-control" name="airline" id="airline" value="<?php echo $review["airline"] ?>" required>
                <div class="invalid-feedback">
                    Field can't be empty
                </div>
                <div>
                    <div>
                        <label for="review">Review</label>
                    </div>
                    <textarea class="form-control" rows="5" cols="33" name="review_text" id="review" required><?php echo $review["review_text"] ?></textarea>
                    <div class="invalid-feedback">
                        Field can't be empty
                    </div>
                </div>
                <div class="star-rating">
                    <input type="radio" class="form-check-input" name="rating" id="star-a" value="5" required>
                    <label for="star-a"></label>
                    <input type="radio" class="form-check-input" name="rating" id="star-b" value="4" required>
                    <label for="star-b"></label>
                    <input type="radio" class="form-check-input" name="rating" id="star-c" value="3" required>
                    <label for="star-c"></label>
                    <input type="radio" class="form-check-input" name="rating" id="star-d" value="2" required>
                    <label for="star-d"></label>
                    <input type="radio" class="form-check-input" name="rating" id="star-e" value="1" required>
                    <label for="star-e"></label>
                </div>
                <div class="invalid-feedback">
                    Field can't be empty
                </div>
                <button class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/5ea815c1d0.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <?php
    require_once('../partials/footer.php');
    ?>