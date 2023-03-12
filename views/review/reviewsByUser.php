<?php
session_start();
require_once('../../controllers/review/reviewsByUser.php');
require_once('../partials/header.php');
?>
</head>

<body>
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
    require_once('../partials/nav.php');
    ?>
    <section class="features-icons bg-light text-center">
        <div class="container">
            <div class="row">
                <?php foreach ($reviews as $review) { ?>
                    <div class="col-lg-4 mb-3">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $review["dep"] . " to " . $review["arr"] ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?php echo $review["author"] ?></h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a class="btn btn-primary" href="show.php?id=<?php echo $review['id'] ?>">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php require_once('../partials/footer.php') ?>;