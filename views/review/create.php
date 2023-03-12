<?php
session_start();
//Redirect to login page if user is not logged authenticated.
if (!isset($_SESSION['user'])) {
    $_SESSION["currUrl"] = "review/" . basename(__FILE__);
    header("Location: ../user/login.php");
    exit;
}
require_once('../partials/header.php');
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>

<body>
    <?php
    require_once('../partials/nav.php');
    ?>
    <div class="container">
        <form class="needs-validation" action="../../controllers/review/create.php" method="post" novalidate>
            <div class="form-group">
                <input type="hidden" name="author" value="<?php echo $_SESSION["user"] ?>">
                <input type="hidden" name="id" value="<?php echo $_SESSION["id"] ?>">
                <label for="dep"> Origin</label>
                <input type="text" class="form-control" name="dep" id="dep" placeholder="Search city or airport code" required>
                <div class="invalid-feedback">
                    Field can't be empty
                </div>
                <label for="arr">Destination</label>
                <input type="text" class="form-control" name="arr" id="arr" placeholder="Search city or airport code" required>
                <div class="invalid-feedback">
                    Field can't be empty
                </div>
                <label for="airline">Airline</label>
                <input type="text" class="form-control" name="airline" id="airline" placeholder="Search airline name" required>
                <div class="invalid-feedback">
                    Field can't be empty
                </div>
                <div class="mb-3">
                    <label for="review" class="form-label">Your review</label>
                    <textarea class="form-control" name="review_text" id="review" rows="3" placeholder="Your review" required></textarea>
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
    <script src="https://kit.fontawesome.com/5ea815c1d0.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <?php
    require_once('../partials/footer.php');
    ?>