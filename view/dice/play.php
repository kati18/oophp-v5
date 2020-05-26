<?php

namespace Anax\View;



/**
 * Render content within an article.
 * A view-file that is posted to route post("dice/play")
 * in file router/200_dice.php
 * Is rendered together with view/cheat.php within route get("dice/play")
 * in file router/200_dice.php
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Dice game 100</h1>

<p>Total result for you: <?= $gameOneHundred->getPlayer()->getStoredScore() ?> points.</p>

<p>Total result for computer: <?= $gameOneHundred->getComputer()->getStoredScore() ?> points.</p>

<form method="post">
    <input type="submit" name="resetGame" value="Reset game">
</form>

<?php if ($gameOneHundred->getActivePlayer() === 1) {
    ?> <p>Active player is: <?= $gameOneHundred->getPlayer()->getPlayerName() ?></p>
    <p>Your score for this round is currently: <?= $gameOneHundred->getPlayer()->getTempScore() ?></p>
    <form method="post">
        <input type="submit" name="rollPlayer" value="Roll dices">
        <input type="submit" name="savePlayer" value="Save score">
    </form> <?php
} ?>

<?php if ($gameOneHundred->getActivePlayer() !== 1) {
    ?> <p>Active player is: <?= $gameOneHundred->getComputer()->getPlayerName() ?></p>
    <form method="post">
        <input type="submit" name="rollComputer" value="Computer roll">
    </form> <?php
} ?>
