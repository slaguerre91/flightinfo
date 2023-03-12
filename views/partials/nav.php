<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Flight Info</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="navbar-brand" href="/FlightInfo/views/index.php">Home</a>
                <a class="navbar-brand" href="">Search</a>
                <a href="review/create.php" class="navbar-brand">Review A Trip</a>

                <?php if (isset($_SESSION["id"])) { ?>
                    <a href="review/reviewsByUser.php?id=<?php echo $_SESSION["id"] ?>" class="navbar-brand">My Reviews</a>
                <?php } ?>
            </div>
        </div>

        <div>
            <?php if (!isset($_SESSION["user"])) { ?>
                <a class="btn btn-primary" href="../views/user/login.php">Sign In</a>
                <a class="btn btn-primary" href="../views/user/register.php">Sign Up</a>
            <?php } else { ?>
                <a class="btn btn-primary" href="/FlightInfo/controllers/user/logout.php">Sign Out</a>
            <?php } ?>
        </div>
    </div>
</nav>