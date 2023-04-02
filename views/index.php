<?php
session_start();
require_once('../controllers/review/recent.php');
?>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Flight Info App</title>
    <!-- Favicon-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:wght@600&display=swap" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon-16x16.png">
    <link rel="manifest" href="assets/site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="d-flex flex-column" id="content">
    <?php if (isset($_SESSION["flash_message"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION["flash_message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        unset($_SESSION["flash_message"]);
        ?>
    <?php } ?>

    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top py-0">
        <div class="container-fluid">
            <a class="navbar-brand py-0" href="."> <img id="logo" src="assets/logo.png" width="55" height="45" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class="navbar-nav">
                    <li>
                        <a class="navbar-brand" href=".">Home</a>
                    </li>
                    <li>
                        <a class="navbar-brand" href="review/search">Search</a>
                    </li>
                    <li>
                        <a href="review/create" class="navbar-brand">Review A Trip</a>
                    </li>
                    <?php if (isset($_SESSION["id"])) { ?>
                        <li>
                            <a href="review/reviewsByUser?id=<?php echo $_SESSION["id"] ?>&page=1" class="navbar-brand">My Reviews</a>
                        </li>
                    <?php } ?>
                    <?php if (!isset($_SESSION["user"])) { ?>
                        <li>
                            <a class="navbar-brand d-lg-none" href="user/login">Sign In</a>
                        </li>
                        <li>
                            <a class="navbar-brand d-lg-none" href="user/register">Sign Up</a>
                        </li>
                    <?php } else { ?>
                        <li>
                            <a class="navbar-brand d-lg-none" href="user/user">My Account</a>
                        </li>
                        <li>
                            <a class="navbar-brand d-lg-none" href="user/routes/logout.php">Sign Out</a>
                        </li>
                    <?php } ?>

                    <?php if (isset($_SESSION["user"]) && $_SESSION["user"] === "administrator") { ?>
                        <li>
                            <a href="admin/index" class="navbar-brand">Admin</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <?php if (!isset($_SESSION["user"])) { ?>
                <a class="btn btn-primary d-none d-lg-inline-block mx-2 navbutton" href="user/login">Sign In</a>
                <a class="btn btn-primary d-none d-lg-inline-block mx-2 navbutton" href="user/register">Sign Up</a>
            <?php } else { ?>
                <a class="navbar-brand d-none d-lg-inline-block" href="user/user">My Account</a>
                <a class="btn btn-primary d-none d-lg-inline-block" href="user/routes/logout.php">Sign Out</a>
            <?php } ?>
        </div>
    </nav>

    <!-- Masthead-->
    <header class="masthead">
    </header>
    <!-- Icons Grid-->
    <section class="features-icons bg-light text-center py-0">
        <div class="container">
            <h1 class="my-5 display-3 fw-bold ls-tight">
                Recent Reviews
            </h1>
            <div class="row">
                <?php foreach ($recentReviews as $review) { ?>
                    <div class="col-lg-4 mb-3">
                        <div class="card mx-auto h-100" style="width: 18rem;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title h-25"><?php echo $review["dep"] . " to " . $review["arr"] ?></h5>
                                <!-- Rating -->
                                <div class="mt-5">
                                    <?php for ($x = 0; $x <= 4; $x++) { ?>
                                        <span class="fa fa-star mt-4 pt-2 <?php if ($review["rating"] > $x) echo 'checked' ?>"></span>
                                    <?php } ?>
                                </div>
                                <p class="card-summary"><?php echo $review["summary"] ?></p>
                                <a class="btn btn-primary mt-auto align-self-end mx-auto" href="review/show?id=<?php echo $review['id'] ?>">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <div class="footer bg-dark mt-4">
        © 2023 Flight info
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>