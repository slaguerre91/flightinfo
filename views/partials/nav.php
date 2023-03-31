<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top py-0">
    <div class="container-fluid">
        <a class="navbar-brand py-0" href="index"> <img id="logo" src="../assets/logo.png" width="55" height="45" class="d-inline-block align-top" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav">
                <li>
                    <a class="navbar-brand" href="../review/index">Home</a>
                </li>
                <li>
                    <a class="navbar-brand" href="../review/search">Search</a>
                </li>
                <li>
                    <a href="../review/create" class="navbar-brand">Review A Trip</a>
                </li>
                <?php if (isset($_SESSION["id"])) { ?>
                    <li>
                        <a href="../review/reviewsByUser?id=<?php echo $_SESSION["id"] ?>&page=1" class="navbar-brand">My Reviews</a>
                    </li>
                <?php } ?>
                <?php if (!isset($_SESSION["user"])) { ?>
                    <li>
                        <a class="navbar-brand d-lg-none" href="../user/login">Sign In</a>
                    </li>
                    <li>
                        <a class="navbar-brand d-lg-none" href="../user/register">Sign Up</a>
                    </li>
                <?php } else { ?>
                    <li>
                        <a class="navbar-brand d-lg-none" href="../user/user">My Account</a>
                    </li>
                    <li>
                        <a class="navbar-brand d-lg-none" href="../user/logout.php">Sign Out</a>
                    </li>
                <?php } ?>

                <?php if (isset($_SESSION["user"]) && $_SESSION["user"] === "administrator") { ?>
                    <li>
                        <a href="../admin/index" class="navbar-brand">Admin</a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <?php if (!isset($_SESSION["user"])) { ?>
            <a class="btn btn-primary d-none d-lg-inline-block mx-2 navbutton" href="../user/login">Sign In</a>
            <a class="btn btn-primary d-none d-lg-inline-block mx-2 navbutton" href="../user/register">Sign Up</a>
        <?php } else { ?>
            <a class="navbar-brand d-none d-lg-inline-block" href="../user/user">My Account</a>
            <a class="btn btn-primary d-none d-lg-inline-block" href="../../controllers/user/logout.php">Sign Out</a>
        <?php } ?>
    </div>
</nav>