<?php
session_start();

include getcwd() . "/includes/fileHandler.php";

$userHandler = new UsersHandler(getcwd() . users_file);
$schoolHandler = new SchoolHandler(getcwd() . schools_file);

if (isset($_GET["school"])) {
    foreach ($userHandler->users as $user) {
        if ($user->school == $_GET['school']) $users[] = $user;
    }
} else $users = $userHandler->users;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Legends | Legends</title>
    <link rel="stylesheet" href="./style/general.css">
    <link rel="stylesheet" href="./style/users.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Piazzolla:ital,wght@1,800&display=swap" rel="stylesheet">
</head>

<body>
    <?php include getcwd() . "/includes/header.php"; ?>
    <main>
        <?php if (isset($users)) : ?>
            <section class="wrapper">
                <?php foreach ($users as $user) : ?>
                    <section class="user" <?php echo isLoggedIn() ? (unserialize($_SESSION['user'])->id == $user->id ? "style='background-color: #FFD700'" : "") : "" ?>>
                        <div class="vote-wrapper">
                            <button onclick="upVote('<?php echo $user->id; ?>')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M24 12l-12-9v5h-12v8h12v5l12-9z" />
                                </svg>
                            </button>
                            <button onclick="downVote('<?php echo $user->id; ?>')">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <path d="M24 12l-12-9v5h-12v8h12v5l12-9z" />
                                </svg>
                            </button>
                        </div>
                        <a href="./legend.php?legend=<?php echo $user->id ?>" class="user-wrapper">
                            <div class="img-container">
                                <img src="<?php echo $user->avatar; ?>" alt="<?php echo $user->nickname; ?>">
                            </div>
                            <div class="text-container">
                                <h1><?php echo $user->nickname; ?></h1>
                                <h2><?php echo $schoolHandler->getSchool($user->school)->full_name ?></h2>
                            </div>
                        </a>
                    </section>
                <?php endforeach; ?>
            </section>
        <?php endif; ?>
    </main>
    <script src="./js/vote.js"></script>
</body>

</html>