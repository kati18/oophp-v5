<?php

declare(strict_types=1);

namespace Anax\View;

/**
 * Render content within an article.
 * A view-file that is added and rendered within route get("diceOneHundred/play")
 * in file router/200_dice.php
 * Is rendered together with view/debug.php within route get("diceOneHundred/play")
 * in file router/200_dice.php
 */

// Show incoming variables and view helper functions:
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Dice game 100</h1>

<!-- Below works but gives error when $lastRollComputer has no value: -->
<!-- <p>Total score computer: <?//= $totScoreComputer ?><br>
Dice values of the last roll of the computer: <?//= implode(", ", $lastRollComputer) ?></p> -->

<!-- Below works but uses two different p-tags: -->
<!-- <p>Total score computer: <?//= $totScoreComputer ?></p>
<?php// if (isset($lastRollComputer)) : ?>
<p>Dice values of the last roll of the computer: <?//= implode(", ", $lastRollComputer) ?> </p>
<?php// endif; ?> -->

<p>Total score computer: <?= $totScoreComputer ?><br>
<?php if (isset($lastRollComputer)) : ?>
Dice values of the last roll of the computer: <?= implode(", ", $lastRollComputer) ?> </p>
<?php endif; ?>


<p>Player: <?= $currentPlayer ?></p>
<p>Total score player: <?= $totScorePlayer ?></p>
<p>Dice values: <?= implode(", ", $diceValues) ?></p>
<p>Round score: <?= $roundScore ?></p>
<!-- <p>Winner: <?//= $gameOver ?></p> -->
<!-- <p>Från route init-play-computer <?//= $katja = $katja ?? null ?> </p> -->

<p>
    <a href="play">
        <button type="button"
        <?php if ($roundScore === 0) {
            ?> disabled <?php
        } ?>>Roll again</button>
    </a>
</p>
<p>
    <a href="save">
        <button type="button"
        <?php if ($roundScore === 0) {
            ?> disabled <?php
        } ?>>Save round score to total score</button>
    </a>
</p>
<p>
    <!-- <p>Spelare: <?//= $currentPlayer ?></p> -->
    <a href="play-you">
        <button type="button"
        <?php if (($roundScore === 0 && $currentPlayer === "You") || ($roundScore > 0)) {
            ?> disabled hidden <?php
        } ?>>Next player is you</button>
    </a>
</p>

<p>
    <a href="play-computer">
        <button type="button"
        <?php if (($roundScore === 0 && $currentPlayer === "Computer") || ($roundScore > 0)) {
            ?> disabled hidden <?php
        } ?>>Next player is the computer - click here to let it roll</button>
    </a>
</p>

<p>
    <a href="restart-init">
        <button type="button">Start from the beginning</button>
    </a>
</p>
