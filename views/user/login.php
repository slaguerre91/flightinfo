<!-- Login page -->
<?php
session_start();
require_once('../partials/header.php');
?>

</head>

<body>
    <!-- Flash message -->
    <?php if (isset($_SESSION["flash_message"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION["flash_message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        unset($_SESSION["flash_message"]);
        ?>
    <?php } ?>
    <?php
    require_once('../partials/nav.php');
    if (isset($_SESSION["flash_message"])) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $_SESSION["flash_message"] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
        unset($_SESSION["flash_message"]);
        ?>
    <?php } ?>
    <!-- Main page content -->
    <div class="container">
        <section class="">
            <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
                <div class="container">
                    <div class="row gx-lg-5 align-items-center">
                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <h1 class="my-5 display-3 fw-bold ls-tight">
                                Book your trip <br />
                                <span class="text-primary">with confidence</span>
                            </h1>
                            <p style="color: hsl(217, 10%, 50.8%)">Browse real flight data before your next trip. No matter the airline or airport, see what your fellow travelers think and make a more informed decision. You can also create an account and share your thoughts on your last trip!
                            </p>
                        </div>

                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <div class="card">
                                <div class="card-body py-5 px-md-5">
                                    <form class="needs-validation" action="routes/login.php" method="post" novalidate>
                                        <div class="form-outline mb-4">
                                            <div class="input-group has-validation">
                                                <input type="text" id="username" class="form-control" name="username" aria-label="username" placeholder="Username" required>
                                                <div class="invalid-feedback">
                                                    Please enter a valid username.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <div class="input-group has-validation">
                                                <input type="password" id="password" class="form-control" name="password" aria-label="password" placeholder="Password" required>
                                                <div class="invalid-feedback">
                                                    Please enter a valid username.
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block mb-4">
                                            Sign In
                                        </button>
                                        <div>
                                            <p style="color: hsl(217, 10%, 50.8%)">Below are the credentials for a test account. Feel free to use them!<br>Username: "testuser"/Password: "flightinfo"</p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<script>
// Disable form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
<?php
require_once('../partials/footer.php');
?>