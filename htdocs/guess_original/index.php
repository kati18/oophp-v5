<?php
/**
 * Main program/handler for the game Guess my number
 */
include(__DIR__ . "/autoload.php");
include(__DIR__ . "/config.php");
include(__DIR__ . "/src/functions.php");

// Deal with incoming $_POST variables
$guess = $_POST["guess"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doInit = $_POST["doInit"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;

// Get current settings from the session($_SESSION)
$number = $_SESSION["number"] ?? null;
$tries = $_SESSION["tries"] ?? null;


if ($doInit || $number === null) {
    $game = new Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();
    // My additions:
    $tries = $_SESSION["tries"];
}
if ($doGuess) {
    $game = new Guess($number, $tries);
    $res = $game->makeGuess($guess);
    $_SESSION["tries"] = $game->tries();
    // My additions:
    $tries = $_SESSION["tries"];
}
if ($doCheat) {
    $game = new Guess($number, $tries);
    $res = $game->number();
}

if ($tries > 0) {
    require __DIR__ . "/view/guess_my_number.php";
} else {
    require __DIR__ . "/view/guess_my_number_game_over.php";
}

//Render the page through the views:
require __DIR__ . "/view/debug_session_post_get.php";
