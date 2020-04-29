<h1>Guess my number</h1>

<p>Guess a number between 1 and 100.</p>

<form method="post">
    <input type="text" name="guess">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?php if ($doGuess) : ?>
    <p>Your guess <?= $guess ?> is <b><?= $res ?> </b></p>
    <p>You have <?= $tries ?> tries left.</p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>CHEAT: The current secret number is <?= $number ?>.</b></p>
    <p>You have <?= $tries ?> tries left.</p>
<?php endif; ?>

<?php if ((int)$guess === $number) : ?>
    <h1><strong>Congratulations, you won!!!</strong></h1>
<?php endif; ?>

<!--
<pre>
<?= var_dump($_POST);?>
-->
