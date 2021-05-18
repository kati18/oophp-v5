<?php

declare(strict_types=1);

namespace Anax\View;

/**
 * Render content within an article.
 * A view-file that is added and rendered within route get("diceOneHundred/win")
 * in file router/200_dice.php
 * Is rendered together with view/debug.php within route get("diceOneHundred/win")
 * in file router/200_dice.php
 */

// Show incoming variables and view helper functions:
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Dice game 100</h1>

<p>Total score computer: <?= $totScoreComputer ?><br>
<?php if ($gameOver === "The computer won the dice game!") : ?>
    Dice values of the last roll of the computer: <?= implode(", ", $lastRollComputer) ?> </p>
<?php endif; ?>

<p>Total score player: <?= $totScorePlayer ?></p>
<p>Winner: <?= $gameOver ?></p>

<p>
    <a href="restart-init">
        <button type="button">Start from the beginning</button>
    </a>
</p>
