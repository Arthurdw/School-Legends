<?php
session_start();
echo getcwd();
include getcwd() . "/includes/fileHandler.php";
include getcwd() . "/includes/loginHandler.php";

if (isLoggedIn()) unset($_SESSION['user']);
Header("Location: ./");
