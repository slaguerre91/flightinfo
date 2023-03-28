<?php
session_start();
require_once('../partials/header.php');
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
</head>

<body>
    <?php
    require_once('../partials/nav.php');
    ?>
    <div class="container my-4 h-75 h-lg-50 bg-light" id=#content>
        <div class="row text-center">
            <div class="col-12">
                <h1 class="my-5 display-3 fw-bold ls-tight">
                    Find reviews for
                    <span class="text-primary">your next trip</span>
                </h1>
            </div>
        </div>
        <div class="row h-100 mt-5">
            <div class="col-12 d-flex justify-content-center">
                <form class="needs-validation w-75" action="results" method="get" novalidate>
                    <div class="form-group">
                        <input type="text" class="form-control my-4" name="dep" id="dep" placeholder="Search city or airport code" aria-label="origin" required>
                        <div class="invalid-feedback">
                            Field can't be empty
                        </div>
                        <input type="text" class="form-control my-2" name="arr" id="arr" placeholder="Search city or airport code" aria-label="destination" required>
                        <div class="invalid-feedback">
                            Field can't be empty
                        </div>
                        <button type="submit" class="btn btn-primary my-4">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <script src="https://kit.fontawesome.com/5ea815c1d0.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <?php
    require_once('../partials/footer.php');
    ?>