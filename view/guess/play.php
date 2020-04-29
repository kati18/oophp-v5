<?php

namespace Anax\View;

// namespace Kati18\Guess;


/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Guess my number</h1>

<p>Guess a number between 1 and 100.</p>
<p <?php if ($tries < 6) {
    ?> hidden <?php
} ?>>You have <?= $tries ?> tries to find out the secret number.</p>

<form method="post">
    <input type="text" name="guess"
    <?php if ($tries < 1 || (int)$guess === $number) {
        ?> disabled <?php
    } ?>>

    <input type="submit" name="doGuess" value="Make a guess"
    <?php if ($tries < 1 || (int)$guess === $number) {
        ?> disabled <?php
    } ?>>

    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat"
    <?php if ($tries < 1 || (int)$guess === $number) {
        ?> disabled <?php
    } ?>>
</form>


<?php if ($res) : ?>
    <p>Your guess <?= $guess ?> is <b><?= $res ?> </b></p>
    <p <?php if ((int)$guess === $number) {
        ?> hidden <?php
       }
        ?>>You have <?= $tries ?> tries left.</p>
    <?php if ($tries < 1) {
        ?> <p>The secret number between 1 and 100 was <?= $number ?>.</p>
    <p>Press Start from beginning to play again.</p> <?php
    } ?>
<?php endif; ?>

<?php if ($numRes) : ?>
    <p>CHEAT: The current secret number is <?= $number ?>.</b></p>
    <p>You have <?= $tries ?> tries left.</p>
<?php endif; ?>

<?php if ((int)$guess === $number) : ?>
    <h1><strong>Congratulations, you won!!!</strong></h1>
    <p>Press Start from beginning to play again.</p>
<?php endif; ?>

<!--
<pre>
<?= var_dump($_POST);?>
-->
