<!-- show review page -->
<?php
session_start();
require_once('../../controllers/review/show.php');
require_once('../partials/header.php');
require_once(__DIR__ . "/../../controllers/helpers/cloudinary.php");
require_once(__DIR__ . '/../../controllers/helpers/airlinelogo.php');

$thumbnailURL = getURL($review["author"]);
?>
</head>

<body>
    <?php
    require_once('../partials/nav.php');
    ?>
    <!-- Main page content-->
    <div class="container mt-5 bg-light">
        <div class="d-flex mb-3">
            <img src="<?php echo getLogo($review["airline"]) ?>" alt="logo">
            <h3 class="align-self-center mx-2"><?php echo $review["airline"] ?></h3>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <article>
                    <header class="mb-4">
                        <h2 class="fw-bolder mb-1"><?php echo $review["dep"] . " to " . $review["arr"] ?></h1>
                            <div class="text-muted fst-italic mb-2">Posted on <?php echo $review["timestamp"] ?> by <a href="reviewsByUser.php?id=<?php echo $review["user_id"] ?>"><?php echo isset($_SESSION["user"]) && $review["author"] == $_SESSION["user"] ? "you" : $review["author"] ?> </a></div>
                    </header>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <?php for ($x = 0; $x <= 4; $x++) { ?>
                        <span class="fa fa-star <?php if ($review["rating"] > $x) echo 'checked' ?>"></span>
                    <?php } ?>
                    <section class="mb-5 mt-5">
                        <p class="fs-5 mb-4" id="summary"><?php echo $review["summary"] ?></p>
                        <p class="fs-5 mb-4"><?php echo $review["review_text"] ?></p>
                    </section>
                </article>
            </div>
            <div class="col-lg-2">
                <div class="card mb-4 mt-2">
                    <div class="card-header"><?php echo $user["username"] ?></div>
                    <div class="m-auto mt-1"><img class="rounded-circle" src="<?php echo $thumbnailURL ?>" alt="user_picture"></div>
                    <div class="card-body"><a href="reviewsByUser?id=<?php echo $user["id"] ?>&page=1">More from <?php echo isset($_SESSION["user"])  && $review["author"] == $_SESSION["user"] ? "you" : $review["author"] ?></a></div>
                </div>
                <div class="d-flex justify-content-center">
                    <?php if (isset($_SESSION["id"]) && $_SESSION["id"] == $review["user_id"]) { ?>
                        <a href="update?id=<?php echo $review["id"] ?>" class="btn btn-primary mx-1"> Update </a>
                        <form action="routes/delete.php" method="post" class="d-inline-block">
                            <input type="hidden" name="id" value="<?php echo $review["id"] ?>">
                            <button class="btn btn-primary mx-1">
                                Delete
                            </button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

<?php
require_once('../partials/footer.php');
?>