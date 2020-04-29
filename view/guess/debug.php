<?php

namespace Anax\View;

// namespace Kati18\Guess;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><hr>
<pre>
SESSION
<?= var_dump($_SESSION); ?>
POST
<?= var_dump($_POST); ?>
GET
<?= var_dump($_GET); ?>
</pre>
<hr>
