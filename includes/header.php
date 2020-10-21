<?php
include getcwd() . "/includes/loginHandler.php";
?>
<!-- The common website header -->
<header>
    <link href="https://fonts.googleapis.com/css2?family=Piazzolla:ital,wght@1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./style/header.css">

    <div class="inner-header-wrapper">
        <a href="./">
            <h1>School Legends</h1>
        </a>
        <nav>
            <a href="./">Home</a>
            <a href="./legends.php">Legends</a>
            <a href="./scholen.php">Scholen</a>
            <?php if (isLoggedIn()) : ?>
                <?php $user = unserialize($_SESSION['user']) ?>
                <div class="inner-wrapper">
                    <a href="./profile.php?user=<?php echo $user->id ?>"><?php echo $user->nickname ?></a>
                    <a class="sign-out" href="./logout.php">Sign Out</a>
                </div>
            <?php else : ?>
                <a href="./login.php">Login/Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>