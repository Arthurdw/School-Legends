<?php 
include getcwd() . "/includes/tokenGeneration.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include getcwd() . "/includes/loginHandler.php";
    include getcwd() . "/includes/fileHandler.php";

    $voteHandler = new VoteHandler(getcwd() . votes_file);
    if (isset($_POST['mode']) && isset($_POST['id']) && isLoggedIn()) {
        if (strtolower($_POST['mode']) == "up") $voteHandler->addVote(unserialize($_SESSION['user'])->id, $_POST['id']);
    }
}

http_response_code(400);