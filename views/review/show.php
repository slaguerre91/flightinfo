<?php
session_start();
require_once('../../controllers/review/show.php');
require_once('../partials/header.php');
require_once(__DIR__ . "/../../controllers/helpers/cloudinary.php");

$thumbnailURL = getURL($review["author"]);
?>
</head>

<body>
    <?php
    require_once('../partials/nav.php');
    ?>
    <!-- Page content-->
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Post content-->
                <article>
                    <!-- Post header-->
                    <header class="mb-4">
                        <h1 class="fw-bolder mb-1"><?php echo $review["dep"] . " to " . $review["arr"] ?></h1>
                        <div class="text-muted fst-italic mb-2">Posted on <?php echo $review["timestamp"] ?> by <a href="reviewsByUser.php?id=<?php echo $review["user_id"] ?>"><?php echo $review["author"] ?> </a></div>
                    </header>
                    <!-- Rating -->
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <?php for ($x = 0; $x <= 4; $x++) { ?>
                        <span class="fa fa-star <?php if ($review["rating"] > $x) echo 'checked' ?>"></span>
                    <?php } ?>
                    <!-- Post content-->
                    <section class="mb-5 mt-5">
                        <p class="fs-5 mb-4"><?php echo $review["review_text"] ?></p>
                    </section>
                </article>
            </div>
            <!-- Side widgets-->
            <div class="col-lg-2">
                <!-- Route side widget
                <div class="card mb-4">
                    <div class="card-header">Route Info</div>
                    <div class="card-body">You can put anything you want inside of these side widgets. They are easy to
                        use, and feature the Bootstrap 5 card component!</div>
                </div> -->
                <!-- User side widget-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo $user["username"] ?></div>
                    <div class="m-auto mt-1"><img class="rounded-circle" src="<?php echo $thumbnailURL ?>" alt=""></div>
                    <div class="card-body"><a href="reviewsByUser?id=<?php echo $user["Id"] ?>">View my other reviews</a></div>
                    <!-- Update and Delete review-->
                    <?php if (isset($_SESSION["id"]) && $_SESSION["id"] == $review["user_id"]) { ?>
                        <a href="update.php?id=<?php echo $review["id"] ?>" class="btn btn-primary"> Update </a>
                        <form action="../../controllers/review/delete.php" method="post" class="d-inline-block">
                            <input type="hidden" name="id" value="<?php echo $review["id"] ?>">
                            <button class="btn btn-primary">
                                Delete
                            </button>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
</body>

<?php
require_once('../partials/footer.php');
?>