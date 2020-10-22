<?php
session_start();
include getcwd() . "/includes/fileHandler.php";
include getcwd() . "/includes/loginHandler.php";

$failed = false;

$preFill = array("", "", "", "");

if (isLoggedIn()) Header("Location: ./");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['name']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['mail']) && isset($_POST['password'])) {
        if (createAccount($_POST['name'], $_POST['first_name'], $_POST['last_name'], $_POST['mail'], $_POST['password'])) {
            // Header("Location: ./");
        }
        $failed = true;
        $preFill = array($_POST['name'], $_POST['first_name'], $_POST['last_name'], $_POST['mail']);
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
                <h3>Oops, it seems like an account with this username already exists!</h3>
            <?php endif; ?>
                <form action="./register.php" method="post">
                    <div>
                        <label for="name">Nickname:</label>
                        <input type="text" id="name" name="name" value="<?php echo $preFill[0] ?>" required autofocus>
                    </div>

                    <div>
                        <label for="first_name">First Name:</label>
                        <input type="text" id="first_name" name="first_name" value="<?php echo $preFill[1] ?>" required autofocus>
                    </div>

                    <div>
                        <label for="last_name">Last Name:</label>
                        <input type="text" id="last_name" name="last_name" value="<?php echo $preFill[2] ?>" required autofocus>
                    </div>

                    <div>
                        <label for="mail">Mail:</label>
                        <input type="email" id="mail" name="mail" value="<?php echo $preFill[3] ?>" required autofocus>
                    </div>

                    <div>
                        <label for="name">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button type="submit">Register</button>
                </form>
            </section>
            <section class="register">
                <a href="./login.php">Already have an account? Sign in here!</a>
            </section>
        </div>
    </main>
</body>

</html>