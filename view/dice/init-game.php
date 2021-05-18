<?php

declare(strict_types=1);

namespace Anax\View;

/**
 * Render content within an article.
 * A view-file that is added and rendered within route get("diceOneHundred/init")
 * in file router/200_dice.php
 * Is rendered together with view/debug.php within route get("diceOneHundred/init")
 * in file router/200_dice.php
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Dice game 100</h1>

<!-- <p>Current player: <?//= $currentPlayer = $currentPlayer ?? null ?> </p>
<p>Player result: <?//= $playerRes ?? null ?>  </p>
<p>Computer result: <?//= $computerRes ?? null ?> </p> -->

<?php if (!isset($currentPlayer)) : ?>
    <?php // if (!isset($currentPlayer) || null) : ?>
    <p>Push the button Roll die to decide who starts to play the dice game.</p>
    <!-- <p>Tryck på knappen Slå tärningen för att avgöra om du eller datorn ska börja spela en runda.</p> -->
    <a href="init-roll">
        <!-- <button type="button">Slå tärningen</button> -->
        <button type="button">Roll die</button>
    </a>
<?php elseif (isset($currentPlayer)) : ?>
    <p>You got a <?= $playerRes ?>:a</p>
    <p>Computer got a <?= $computerRes ?>:a</p>
    <p><?= $currentPlayer ?> start(s) to play the dice game.</p>
        <?php if ($currentPlayer === "You") : ?>
            <a href="play">
                <button type="button">Play</button>
            </a>
        <?php elseif ($currentPlayer === "Computer") : ?>
            <a href="init-play-computer">
                <button type="button">Let the computer play</button>
            </a>
        <?php endif; ?>
<?php endif; ?>
