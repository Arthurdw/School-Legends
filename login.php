<?php
session_start();
include getcwd() . "/includes/fileHandler.php";
include getcwd() . "/includes/loginHandler.php";

$failed = false;

if (isLoggedIn()) Header("Location: ./");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['name']) && isset($_POST['password'])) {
        if (signIn($_POST['name'], $_POST['password'])) {
            Header("Location: ./");
        }
        $failed = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Legends | Home</title>
    <link rel="stylesheet" href="./style/general.css">
    <link rel="stylesheet" href="./style/login.css">
    <link rel="stylesheet" href="./style/loginHeader.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Piazzolla:ital,wght@1,800&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <h1><a href="./">School Legends</a></h1>
    </header>
    <main>
        <div class="wrapper">
            <section class="sign-in">
            <?php if ($failed): ?>
                <h3>Oops, it seems like the wrong credentials got entered!</h3>
            <?php endif; ?>
                <form action="./login.php" method="post">
                    <div>
                        <label for="name">Name/Mail:</label>
                        <input type="text" id="name" name="name" required autofocus>
                    </div>

                    <div>
                        <label for="name">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button type="submit">Sign In</button>
                </form>
            </section>
            <section class="register">
                <a href="./register.php">Don't have an account? Register here!</a>
            </section>
        </div>
    </main>
</body>

</html>