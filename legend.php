<?php
if (!isset($_GET['legend'])) Header("Location: ./legends.php");

session_start();

include getcwd() . "/includes/fileHandler.php";


function getUser()
{
    $userHandler = new UsersHandler(getcwd() . users_file);
    foreach ($userHandler->users as $user) {
        if ($user->id == $_GET['legend']) return $user;
    }
    return null;
}

$user = getUser();
if ($user == null) Header("Location: ./legends.php");
$schoolHandler = new SchoolHandler(getcwd() . schools_file);
$school = $schoolHandler->getSchool($user->school);
$voteHandler = new VoteHandler(getcwd() . votes_file);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./style/general.css">
    <link rel="stylesheet" href="./style/legend.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Legends | Legend</title>
</head>

<body>
    <?php include getcwd() . "/includes/header.php"; ?>
    <main>
        <div class="wrapper">
            <div class="votes">
                <h2>Upvotes: <span><?php echo count($voteHandler->getPostVotes($user->id)); ?></span></h2>
            </div>
            <div class="user">
                <img src="<?php echo $user->avatar; ?>" alt="<?php echo $user->nickname; ?> their profile picture">
                <h1><?php echo $user->nickname; ?></h1>
            </div>
            <a class="school" href="./legends.php?school=<?php echo $school->id; ?>">
                <img src="<?php echo $school->icon; ?>" alt="<?php echo $school->short_name ?> their icon">
                <h2><?php echo $school->full_name; ?></h2>
            </a>
        </div>
    </main>
</body>

</html>