<?php
session_start();
require_once('../../controllers/review/reviewsByUser.php');
require_once('../partials/header.php');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                        <div class="card mx-auto h-100" style="width: 18rem;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title h-25"><?php echo $review["dep"] . " to " . $review["arr"] ?></h5>
                                <!-- Rating -->
                                <div class="mt-5">
                                    <?php for ($x = 0; $x <= 4; $x++) { ?>
                                        <span class="fa fa-star <?php if ($review["rating"] > $x) echo 'checked' ?>"></span>
                                    <?php } ?>
                                </div>
                                <p class="card-summary"><?php echo $review["summary"] ?></p>
                                <a class="btn btn-primary mt-auto align-self-end mx-auto" href="show?id=<?php echo $review['id'] ?>">Read More</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <nav aria-label="Page navigation example" class="bg-light fixed-bottom my-4">
        <ul class="pagination d-flex justify-content-center">
            <li class="page-item"><a class="page-link" href="reviewsByUser?id=<?php echo $review["user_id"] ?>&page=<?php echo (!empty($_GET["page"]) && $_GET["page"] != 1) ? $_GET["page"] - 1 : 1 ?>">Previous</a></li>
            <?php for ($i = 1; $i <= ceil(count($totalReviews) / 12); $i++) { ?>
                <li class="page-item"><a class="page-link" href="reviewsByUser?id=<?php echo $review["user_id"] ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php } ?>
            <li class="page-item"><a class="page-link" href="reviewsByUser?id=<?php echo $review["user_id"] ?>&page=<?php echo (!empty($_GET["page"]) && $_GET["page"] != ceil(count($totalReviews) / 10)) ? $_GET["page"] + 1 : 1 ?>">Next</a></li>
        </ul>
    </nav>
    <?php require_once('../partials/footer.php') ?>;