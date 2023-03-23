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
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Active</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $result['airline'] ?></h5>
                    <p class="card-text">Average rating: <?php echo $result['rating'] ?></p>
                    <p class="card-text">Total reviews: <?php echo $result['review_count'] ?></p>
                    <a href="reviewsByRoute?airline=<?php echo $result['airline'] ?>&dep=<?php echo $result['dep'] ?>&arr=<?php echo $result['arr'] ?>&page=1" class="navbar-brand">Read Reviews</a>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php require_once('../partials/footer.php') ?>;