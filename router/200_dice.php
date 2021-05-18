<?php

namespace Kati18\Dice;

// Pre inheritance from class GameRound.

/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Init the dice 100 game by rendering the view-file view/init-game.php and there informing
 * about having to decide who starts playing by pressing a roll button "Roll die" that
 * redirects to route "diceOneHundred/init-roll".
 */
$app->router->get("diceOneHundred/init", function () use ($app) {

    // Get current values from session:
    $currentPlayer = $app->session->get("currentPlayer", null);
    $playerRes = $app->session->get("playerRes", null);
    $computerRes = $app->session->get("computerRes", null);

    $title = "Dice 100 game";

    $data = [
        "currentPlayer" => $currentPlayer,
        "playerRes" => $playerRes,
        "computerRes" => $computerRes
    ];

    $app->session->set("currentPlayer", null);
    $app->session->set("playerRes", null);
    $app->session->set("computerRes", null);
    $app->session->set("lastRollComputer", null);

    $app->page->add("dice/init-game", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
* Play the dice game - in use when to decide who gets to start playing the dice game
* by rolling one die and comparing the face values. If the same face value the computer
* rolls again.
*/
$app->router->get("diceOneHundred/init-roll", function () use ($app) {
    $title = "Play the Dice 100 game";

    $gameOneHundredA = new GameOneHundred();

    $playerInitDie = new Dice();
    $playerInitDie->rollDice();
    $playerRes = $playerInitDie->getLastRollFaceDice();
    $app->session->set("playerRes", $playerRes);

    $computerInitDie = new Dice();
    $computerInitDie->rollDice();
    $computerRes = $computerInitDie->getLastRollFaceDice();

    $computerRes = $computerInitDie->getInitRollFaceDice($playerRes, $computerRes);

    $app->session->set("computerRes", $computerRes);

    $gameOneHundredA->setInitCurrPlayerGame($playerRes, $computerRes);
    $currentPlayer = $gameOneHundredA->getCurrentPlayerGame();

    $app->session->set("currentPlayer", $currentPlayer);

    $gameOneHundred = new GameOneHundred($currentPlayer);
    $app->session->set("gameOneHundred", $gameOneHundred);

    return $app->response->redirect("diceOneHundred/init");
});


/**
 * Play the dice game - shows game status and buttons for the player You to use
 * when playing.
 */
$app->router->get("diceOneHundred/play", function () use ($app) {
    $title = "Play the Dice 100 game";

    $lastRollComputer = $app->session->get("lastRollComputer", null);
    $gameOneHundred = $app->session->get("gameOneHundred", null);
    $gameOneHundred->rollGame();
    // Set the round score:
    $gameOneHundred->setRoundScoreGame();

    $data = [ //data to send to the view-file
        "currentPlayer" => $gameOneHundred->getCurrentPlayerGame(),
        "totScorePlayer" => $gameOneHundred->getTotScorePlayer(),
        "totScoreComputer" => $gameOneHundred->getTotScoreComputer(),
        "gameOneHundred" => $gameOneHundred,
        "diceValues" => $gameOneHundred->getDiceFacesGame(),
        "roundScore" => $gameOneHundred->getRoundScoreGame(),
        "gameOver" => $gameOneHundred->gameOver(),
        "lastRollComputer" => $lastRollComputer
    ];

    $app->session->set("currentPlayer", null);
    $app->session->set("playerRes", null);
    $app->session->set("computerRes", null);

    //Below: ("dice/play-result") = ("view/dice/play-result.php")
    $app->page->add("dice/play-result", $data);
    // $app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the dice game
 * - saves the roundScore to the totalScore,
 * - changes current players,
 * - checks if there is a winner i.e. checks if the current player´s
 * total score is equal to or more than 100
 */
$app->router->get("diceOneHundred/save", function () use ($app) {
    $title = "Play the Dice 100 game";

    // Deal with session variables:
    $gameOneHundred = $app->session->get("gameOneHundred", null);

    // Set the total score of the current player:
    $gameOneHundred->setTotScoreGame();

    // Get the faces of last roll and save it in the session:
    $app->session->set("lastRollComputer", $gameOneHundred->getDiceFacesGame());

    $gameOver = $gameOneHundred->gameOver();

    $gameOneHundred->changeCurrentPlayerGame();

    // Save ongoing game in session. Not necessary it seems 210517 kl. 12:
    // $app->session->set("gameOneHundred", $gameOneHundred);

    // $totScorePlayer = $gameOneHundred->getTotScorePlayer();
    // echo $totScorePlayer;
    // $totScoreComputer = $gameOneHundred->getTotScoreComputer();
    // echo $totScoreComputer;
    $currentPlayer = $gameOneHundred->getCurrentPlayerGame();

    // $data = [ //data to send to the view-file
    //     "currentPlayer" => $currentPlayer,
    //     "totScorePlayer" => $totScorePlayer,
    //     "totScoreComputer" => $totScoreComputer
    // ];

    if ($gameOver != null) {
        return $app->response->redirect("diceOneHundred/win");
    } else {
        if ($currentPlayer == "Computer") {
            return $app->response->redirect("diceOneHundred/init-play-computer");
        }

        if ($currentPlayer == "You") {
            return $app->response->redirect("diceOneHundred/play");
        }
    }
});


/**
 * Play the dice game - in use when the current player wins i.e.
 * when the current player´s total score is equal to or more than 100.
 */
$app->router->get("diceOneHundred/win", function () use ($app) {
    $title = "Play the Dice 100 game";

    $gameOneHundred = $app->session->get("gameOneHundred", null);
    $lastRollComputer = $app->session->get("lastRollComputer", null);

    $data = [ //data to send to the view-file
        "totScorePlayer" => $gameOneHundred->getTotScorePlayer(),
        "totScoreComputer" => $gameOneHundred->getTotScoreComputer(),
        "gameOver" => $gameOneHundred->gameOver(),
        "lastRollComputer" => $lastRollComputer
    ];

    // Below: ("dice/play-result") = ("view/dice/play-win.php")
    $app->page->add("dice/play-win", $data);
    // $app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Play the dice game - in use when computer plays for the first time after rolling the initial
 * die and the button "Let the computer play" is pushed. Is also in use after player You saves
 * round score to total score by pushing the button "Save round score to total score".
 */
$app->router->get("diceOneHundred/init-play-computer", function () use ($app) {
    $title = "Play the Dice 100 game";

    $gameOneHundred = $app->session->get("gameOneHundred", null);

    $gameOneHundred->computerPlay();

    return $app->response->redirect("diceOneHundred/save");
});


/**
 * Play the dice game - in use after player You got a 1
 * and the button "Next player is the computer" is pushed
 */
$app->router->get("diceOneHundred/play-computer", function () use ($app) {
    $title = "Play the Dice 100 game";

    $gameOneHundred = $app->session->get("gameOneHundred", null);
    $gameOneHundred->changeCurrentPlayerGame();

    $gameOneHundred->computerPlay();

    return $app->response->redirect("diceOneHundred/save");
});


// /**
//  * Play the dice game - not in use after autoplaying of the computer is
//  * implemented. Before that in use after player Computer got a 1
//  * and the button "Next player is you" is pushed.
//  */
// $app->router->get("diceOneHundred/play-you", function () use ($app) {
//     $title = "Play the Dice 100 game";
//
//     $gameOneHundred = $app->session->get("gameOneHundred", null);
//     $gameOneHundred->changeCurrentPlayerGame();
//
//     return $app->response->redirect("diceOneHundred/play");
// });


/**
* Play the dice game - in use after the button "Start from the beginning" is pushed
*/
$app->router->get("diceOneHundred/restart-init", function () use ($app) {
    $title = "Play the Dice 100 game";

    $app->session->set("playerRes", null);
    $app->session->set("computerRes", null);
    $app->session->set("currentPlayer", null);
    $app->session->set("gameOneHundred", null);
    $app->session->set("lastRollComputer", null);

    return $app->response->redirect("diceOneHundred/init");
});
