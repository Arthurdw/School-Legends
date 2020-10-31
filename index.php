<?php
session_start();

include getcwd() . "/includes/fileHandler.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Legends | Home</title>
    <link rel="stylesheet" href="./style/general.css">
    <link rel="stylesheet" href="./style/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Piazzolla:ital,wght@1,800&display=swap" rel="stylesheet">
</head>

<body>
    <?php include getcwd() . "/includes/header.php"; ?>
    <main>
        <div class="wrapper">
            <h1>Everyone has that one or more legends in their school, view and vote for them here!</h1>
            <h4>Sitemap:</h4>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./legends.php">View all the legends!</a></li>
                <li><a href="./scholen.php">View all the schools!</a></li>
                <li><a href="./login.php">Sign In!</a></li>
            </ul>
        </div>
    </main>
</body>

</html>