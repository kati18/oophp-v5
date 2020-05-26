<?php
namespace Kati18\Dice;

/**
 * Throw a hand of dices.
 */
include(__DIR__ . "/autoload_namespace.php");
include(__DIR__ . "/config.php");

$hand = new DiceHand();
$hand->roll();

?><h1>Rolling a dicehand with five dices</h1>

<p><?= implode(", ", $hand->values()) ?></p>
<p>Sum is: <?= $hand->sum() ?></p>
<p>Average is: <?= $hand->average() ?></p>
