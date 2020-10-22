<?php
session_start();

include getcwd() . "/includes/fileHandler.php";

$schoolHandler = new SchoolHandler(getcwd() . schools_file);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Legends | Scholen</title>
    <link rel="stylesheet" href="./style/general.css">
    <link rel="stylesheet" href="./style/schools.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Piazzolla:ital,wght@1,800&display=swap" rel="stylesheet">
</head>

<body>
    <?php include getcwd() . "/includes/header.php"; ?>
    <main>
        <section class="wrapper">
            <?php foreach ($schoolHandler->schools as $school) : ?>
                <section class="school-wrapper">
                    <div class="img-container">
                        <img src="<?php echo $school->icon; ?>" alt="<?php echo $school->short_name; ?>">
                    </div>
                    <div class="text-container">
                        <h1><?php echo $school->full_name; ?> (<?php echo $school->short_name; ?>)</h1>
                    </div>
                    <a href="./legends.php?school=<?php echo $school->id; ?>">Bekijk de school legends!</a>
                </section>
            <?php endforeach; ?></section>
    </main>
</body>

</html>