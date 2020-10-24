<?php
include getcwd() . "/includes/tokenGeneration.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();

    include getcwd() . "/includes/fileHandler.php";
    include getcwd() . "/includes/loginHandler.php";

    $voteHandler = new VoteHandler(getcwd() . votes_file);

    if (isset($_POST['mode']) && isset($_POST['id']) && isLoggedIn()) {
        if (strtolower($_POST['mode']) == "up") {
            $freshVote = $voteHandler->addVote(unserialize($_SESSION['user'])->id, $_POST['id']);

            if (!$freshVote) http_response_code(403);
            else http_response_code(201);
        } else if (strtolower($_POST['mode']) == "down") {
            $voteRemoved = $voteHandler->removeVote(unserialize($_SESSION['user'])->id, $_POST['id']);

            if (!$voteRemoved) return http_response_code(403);
            else http_response_code(201);
        }
    } else if (!isLoggedIn()) http_response_code(401);
    else http_response_code(400);
}

