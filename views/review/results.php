<?php
session_start();
require_once('../partials/header.php');
require_once('../../controllers/review/search.php');
?>
</head>

<body>
    <!-- Navigation-->
    <?php
    require_once('../partials/nav.php');
    ?>
    <div class="container">
        <?php foreach ($searchResults as $result) { ?>
            <div class="card text-center my-4">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $result['airline'] ?></h5>
                    <p class="card-text">Average rating: <?php echo round($result['rating'], 1) . "/5" ?></p>
                    <p class="card-text">Total reviews: <?php echo $result['review_count'] ?></p>
                    <a href="reviewsByRoute?airline=<?php echo $result['airline'] ?>&dep=<?php echo $result['dep'] ?>&arr=<?php echo $result['arr'] ?>&page=1" class="btn btn-primary">Read Reviews</a>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php require_once('../partials/footer.php') ?>;