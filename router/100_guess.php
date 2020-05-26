<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Inite the guess game and redirect to play the guess game.
 */
$app->router->get("guess/init", function () use ($app) {
    // init the session/update $_SESSION for the gamestart or restart if $doInit).

    // $_SESSION["number"] = null; alt below:
    $app->session->set("number", null);

    // $_SESSION["tries"] = null; alt below:
    $app->session->set("tries", null);

    $game = new Kati18\Guess\Guess();

    // $_SESSION["number"] = $game->number(); alt below:
    // $gameNumber = $game->number();
    // $app->session->set("number", $gameNumber); = below:
    $app->session->set("number", $game->number());


    // $_SESSION["tries"] = $game->tries(); alt below:
    // $gameTries = $game->tries();
    // $app->session->set("tries", $gameTries);
    $app->session->set("tries", $game->tries());

    return $app->response->redirect("guess/play");
});



/**
 * Play the guess game - show game status.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the guess game";

    // Get current settings from the session($_SESSION)
    $tries = $_SESSION["tries"] ?? null;
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $number = $_SESSION["number"] ?? null;
    $numRes = $_SESSION["numRes"] ?? null;
    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;
    $_SESSION["numRes"] = null;

    $data = [ //data to send to the view-file
        "guess" => $guess ?? null,
        "res" => $res,
        "tries" => $tries,
        "number" => $number ?? null,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,
        "numRes" => $numRes ?? null,
    ];
    //Below: ("guess/play") = ("view/guess/play.php")
    $app->page->add("guess/play", $data);
    $app->page->add("guess/cheat", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the guess game - make a guess.
 */
$app->router->post("guess/play", function () use ($app) {
    $title = "Play the guess game";

    // Deal with incoming $_POST variables
    // $guess = $_POST["guess"] ?? null; alt below:
    $guess = $app->request->getPost("guess", null);
    // $doGuess = $_POST["doGuess"] ?? null; alt below:
    $doGuess = $app->request->getPost("doGuess", null);

    // Get current settings from the session($_SESSION)
    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;
    $res = null;

    if ($doGuess) {
        $game = new Kati18\Guess\Guess($number, $tries);
        $res = $game->makeGuess($guess);
        $_SESSION["tries"] = $game->tries();
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;
        // My addition. 200507 not sure if necessary:
        $tries = $_SESSION["tries"];

        return $app->response->redirect("guess/play");
    }

// alt below. If below - $doGuess = $_POST["doGuess"] ?? null; on row 70 not necessary.
    // $game = new Kati18\Guess\Guess($number, $tries);
    // $res = $game->makeGuess($guess);
    // $_SESSION["tries"] = $game->tries();
    // $_SESSION["res"] = $res;
    // $_SESSION["guess"] = $guess;
    // // My addition:
    // $tries = $_SESSION["tries"];
    //
    // return $app->response->redirect("guess/play");
});


$app->router->get("guess/doInit", function () use ($app) {
    // doInit
    return $app->response->redirect("guess/init");
});


$app->router->post("guess/doCheat", function () use ($app) {
    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;

    $game = new Kati18\Guess\Guess($number, $tries);
    $numRes = $game->number();
    $_SESSION["numRes"] = $numRes;
    $_SESSION["guess"] = null;

    return $app->response->redirect("guess/play");
});
