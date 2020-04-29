<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Inite the guess game and redirect to play the guess game.
 */
$app->router->get("guess/init", function () use ($app) {
    // init the session for the gamestart or restart (doInit).
    $_SESSION["number"] = null;
    $_SESSION["tries"] = null;
    $game = new Kati18\Guess\Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();

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

    $data = [
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
    $guess = $_POST["guess"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

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
        // My addition:
        $tries = $_SESSION["tries"];

        return $app->response->redirect("guess/play");
    }

    if ($doCheat) {
        return $app->response->redirect("guess/doCheat");
    }

    if ($doInit || $number === null) {
        return $app->response->redirect("guess/init");
    }
});


$app->router->get("guess/doCheat", function () use ($app) {
    // doCheat
    // Get current settings from the session($_SESSION)
    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;

    $game = new Kati18\Guess\Guess($number, $tries);
    $numRes = $game->number();
    $_SESSION["numRes"] = $numRes;
    $_SESSION["guess"] = null;

    return $app->response->redirect("guess/play");
});


//For debugging:
// ?>
<!-- <hr>
<pre>
SESSION -->
<!-- <?= var_dump($_SESSION); ?> -->
<!-- POST -->
<!-- <?= var_dump($_POST); ?> -->
<!-- GET -->
<!-- <?= var_dump($_GET); ?> -->
<!-- </pre>
<hr> -->
<?php
// die();
