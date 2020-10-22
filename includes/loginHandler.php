<?php
$userHandler = new UsersHandler(getcwd() . users_file);

function generateToken($length = 32) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function isLoggedIn()
{
    return isset($_SESSION['user']);
}

function signIn($name, $pass)
{
    global $userHandler;

    foreach ($userHandler->users as $user) {
        if ((strtolower($user->nickname) == strtolower($name) ||
                strtolower($user->mail) == strtolower($name)) &&
            $user->password == $pass
        ) {
            $_SESSION['user'] = serialize($user);
            return true;
        }
    }
    return false;
}

function createAccount($nick, $first, $last, $mail, $password) {
    // echo generateToken();
    return true;
}
