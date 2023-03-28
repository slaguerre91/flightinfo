<?php
session_start();
require_once('../controllers/review/recent.php');
require_once('partials/header.php');

?>
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
    <?php
    require_once('partials/nav.php');
    ?>

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
                            <div class="card-body h-100">
                                <h5 class="card-title h-25"><?php echo $review["dep"] . " to " . $review["arr"] ?></h5>
                                <!-- Rating -->
                                <?php for ($x = 0; $x <= 4; $x++) { ?>
                                    <span class="fa fa-star mt-4 pt-2 <?php if ($review["rating"] > $x) echo 'checked' ?>"></span>
                                <?php } ?>
                                <p class="card-summary h-25"><?php echo $review["summary"] ?></p>
                                <div class="mt-4">
                                    <a class="btn btn-primary" href="review/show.php?id=<?php echo $review['id'] ?>">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php require_once('partials/footer.php') ?>;