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
    <div class="container">
        <form class="needs-validation" action="results" method="get" novalidate>
            <div class="form-group">
                <label for="dep"> Origin</label>
                <input type="text" class="form-control" name="dep" id="dep" placeholder="Search city or airport code" required>
                <div class="invalid-feedback">
                    Field can't be empty
                </div>
                <label for="arr">Destination</label>
                <input type="text" class="form-control" name="arr" id="arr" placeholder="Search city or airport code" required>
                <div class="invalid-feedback">
                    Field can't be empty
                </div>
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
    <script src="https://kit.fontawesome.com/5ea815c1d0.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <?php
    require_once('../partials/footer.php');
    ?>