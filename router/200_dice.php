<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Inite the dice 100 game and redirect to play the dice game.
 */
$app->router->get("diceOneHundred/init", function () use ($app) {
    // init the session/update $_SESSION for the gamestart or restart if $doInit).

    $gameOneHundred = new Kati18\Dice\GameOneHundred();
    $app->session->set("gameOneHundred", $gameOneHundred);

    return $app->response->redirect("diceOneHundred/play");
});


/**
 * Play the dice game - show game status.
 */
$app->router->get("diceOneHundred/play", function () use ($app) {
    $title = "Play the Dice 100 game";

    $gameOneHundred = $app->session->get("gameOneHundred");

    $dice = "Fungerar detta?";

    $data = [ //data to send to the view-file
        "dice" => $dice,
        "gameOneHundred" => $gameOneHundred
    ];
    //Below: ("guess/play") = ("view/guess/play.php")
    $app->page->add("dice/play", $data);
    // $app->page->add("guess/cheat", $data);
    $app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the dice 100 game
 */
$app->router->post("diceOneHundred/play", function () use ($app) {
    $title = "Play the dice game";

    // Deal with incoming $_POST variables
    // $guess = $_POST["resetGame"] ?? null; alt below:
    $resetGame = $app->request->getPost("resetGame", null);
    // $doGuess = $_POST["rollPlayer"] ?? null; alt below:
    $rollPlayer = $app->request->getPost("rollPlayer", null);
    // $guess = $_POST["savePlayer"] ?? null; alt below:
    $savePlayer = $app->request->getPost("savePlayer", null);
    // $doGuess = $_POST["rollComputer"] ?? null; alt below:
    $rollComputer = $app->request->getPost("rollComputer", null);


    // Get current settings from the session($_SESSION)
    $gameOneHundred = $app->session->get("gameOneHundred");

    if ($resetGame) {
        return $app->response->redirect("diceOneHundred/init");
    }

    // if ($doGuess) {
    //     $game = new Kati18\Guess\Guess($number, $tries);
    //     $res = $game->makeGuess($guess);
    //     $_SESSION["tries"] = $game->tries();
    //     $_SESSION["res"] = $res;
    //     $_SESSION["guess"] = $guess;
    //     // My addition. 200507 not sure if necessary:
    //     $tries = $_SESSION["tries"];
    //
    //     return $app->response->redirect("diceOneHundred/play");
    // }
    if ($rollPlayer) {
        // $gameOneHundred->getPlayer()->getDiceHand()->roll();
        $gameOneHundred->rollPlayer();
    }
    if ($savePlayer) {

    }
    if($rollComputer) {

    }

});
