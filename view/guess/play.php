<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<h1>Spela gissa mitt nummer</h1>

<p>Gissa på ett nummer mellan 1 and 100, du har <?= $tries ?> försök kvar.</p>

<form method="post">
    <input type="text" name="guess">
    <input type="submit" name="doGuess" value="Gissa" <?= ($tries === 0) ? "disabled" : "" ?> >
    <input type="submit" name="doInit" value="Starta nytt spel">
    <input type="submit" name="doCheat" value="Fuska">
</form>

<?php if ($res) : ?>
    <?php if ($res === "RÄTT!") : ?>
        <h3>Din gissning <?= $guess ?> är <?= $res ?> </h3>
    <?php else : ?>
        <p>Din gissning <?= $guess ?> är <strong> <?= $res ?> </strong></p>
    <?php endif ; ?>
<?php endif ; ?>

<?php if ($doCheat) : ?>
    <p>Fusk: nuvarande nummer är: <?= $number ?> </p>
<?php endif ; ?>
