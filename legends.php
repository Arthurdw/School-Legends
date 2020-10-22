<?php
session_start();

include getcwd() . "/includes/fileHandler.php";

$userHandler = new UsersHandler(getcwd() . users_file);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Legends | Legends</title>
    <link rel="stylesheet" href="./style/general.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Piazzolla:ital,wght@1,800&display=swap" rel="stylesheet">
</head>

<body>
    <?php include getcwd() . "/includes/header.php"; ?>
    <main>
        <?php foreach ($userHandler->users as $user) : ?>
            <section>
                <div class="vote-wrapper">
                    <button onclick="upVote('<?php echo $user->id; ?>')"></button>
                    <button onclick="downVote('<?php echo $user->id; ?>')"></button>
                </div>
                <div class="user-wrapper">
                    <div class="img-container">
                        <img src="<?php echo $user->avatar; ?>" alt="<?php echo $user->nickname; ?>">
                    </div>
                    <div class="text-container">
                        <h1><?php echo $user->nickname; ?></h1>
                    </div>
                </div>
            </section>
        <?php endforeach; ?>
    </main>
    <script src="./js/vote.js"></script>
</body>

</html>