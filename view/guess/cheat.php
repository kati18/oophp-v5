<?php

namespace Anax\View;

/**
 * Render content within an article.
 * A view-file that is posted to route post("guess/doCheat")
 * in file router/100_guess.php.
 * Is rendered together with view/play.php within route get("guess/play")
 * in file router/100_guess.php.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<!--action="doCheat" below as in route post("guess/doCheat") in file router/100_guess.php:-->
<form method="post" action="doCheat">
    <?php
    if ($tries < 1 || (int)$guess === $number) {
        ?>
    <input type="submit" name="Cheat" value="Cheat" disabled>
        <?php
    } else {
        ?>
    <p>Press cheat below to find out the secret number while guessing.</p>
    <input type="submit" name="Cheat" value="Cheat">
        <?php
    }
    ?>
</form>

<?php if ($numRes) : ?>
    <p>The secret number is: <?= $numRes ?> </p>
    <p>You have <?= $tries ?> tries left.</p>
<?php endif; ?>
