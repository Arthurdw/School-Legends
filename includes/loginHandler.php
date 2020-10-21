<?php
$userHandler = new UsersHandler(getcwd() . users_file);

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
