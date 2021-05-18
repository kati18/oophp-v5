<?php

namespace Anax\View;

/**
 * Render content within an article.
 * A view-file(form) that is posted to route post("guess/play")
 * in file router/100_guess.php
 * Is rendered together with view/cheat.php within route get("guess/play")
 * in file router/100_guess.php
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>Guess my number</h1>

<p>Guess a number between 1 and 100.</p>
<p
<?php if ($tries < 6) {
    ?> hidden <?php
} ?>>You have <?= $tries ?> tries to find out the secret number.</p>

<!-- A form posted to itself i. e. to route post("guess/play") in file router/100_guess.php: -->
<form method="post">
    <input type="text" name="guess" required
    <?php if ($tries < 1 || (int)$guess === $number) {
        ?> disabled <?php
    } ?>>

    <input type="submit" name="doGuess" value="Make a guess"
    <?php if ($tries < 1 || (int)$guess === $number) {
        ?> disabled <?php
    } ?>>

    <!-- <a href="/oophp/me/redovisa/htdocs/guess/doInit">Start from beginning</a> alt below:-->
    <a href="doInit">Start from beginning</a>
    <!-- href="doInit" above as in route get("guess/doInit") in file router/100_guess.php-->
<!-- For a button instead, se below: -->
    <a href="doInit">
        <button type="button">Start from beginning</button>
    </a>

</form>


<?php if ($res) : ?>
    <p>Your guess <?= $guess ?> is <b><?= $res ?> </b></p>
    <p
    <?php if ((int)$guess === $number) {
        ?> hidden <?php
    } ?>>You have <?= $tries ?> tries left.</p>
    <?php if ($tries < 1 && (int)$guess !== $number) {
        ?> <p>The secret number between 1 and 100 was <?= $number ?>.</p>
    <p>Press Start from beginning to play again.</p> <?php
    } ?>
<?php endif; ?>


<?php if ((int)$guess === $number) : ?>
    <h2><strong>Congratulations, you won!!!</strong></h2>
    <p>Press Start from beginning to play again.</p>
<?php endif; ?>

<!--
<pre>
<?= var_dump($_POST);?>
-->
