<?php
session_start();
require_once('../../controllers/review/reviewsByRoute.php');
require_once('../partials/header.php');
require_once(__DIR__ . '/../../controllers/helpers/airlinelogo.php');

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Navigation-->
    <?php
    require_once('../partials/nav.php');
    ?>
    <section class="features-icons bg-light text-center">
        <div class="container">
            <img src="<?php echo getLogo($reviews[0]["airline"]) ?>" alt="logo">
            <h1 class="mb-4"><?php echo $reviews[0]["airline"] ?></h1>
            <div class="row">
                <?php foreach ($reviews as $review) { ?>
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
            <li class="page-item"><a class="page-link" href="reviewsByRoute?airline=<?php echo $review['airline'] ?>&dep=<?php echo $review['dep'] ?>&arr=<?php echo $review['arr'] ?>&page=<?php echo (!empty($_GET["page"]) && $_GET["page"] != 1) ? $_GET["page"] - 1 : 1 ?>">Previous</a></li>
            <?php for ($i = 1; $i <= ceil(count($totalReviews) / 12); $i++) { ?>
                <li class="page-item"><a class="page-link" href="reviewsByRoute?airline=<?php echo $review['airline'] ?>&dep=<?php echo $review['dep'] ?>&arr=<?php echo $review['arr'] ?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
            <?php } ?>
            <li class="page-item"><a class="page-link" href="reviewsByRoute?airline=<?php echo $review['airline'] ?>&dep=<?php echo $review['dep'] ?>&arr=<?php echo $review['arr'] ?>&page=<?php echo (!empty($_GET["page"]) && $_GET["page"] != ceil(count($totalReviews) / 12)) ? $_GET["page"] + 1 : 1 ?>">Next</a></li>
        </ul>
    </nav>
    <?php require_once('../partials/footer.php') ?>;