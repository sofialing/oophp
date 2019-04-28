<?php

namespace Anax\View;

/**
 * Render the page for 'dice game 100'
 */

?>

<?php if ($endGame === null) { ?>
    <h1><?= $name[$currentPlayer] ?>s tur att kasta tärningarna</h1>
<?php } else { ?>
    <h1><?= $endGame ?> </h1>
<?php } ?>

<form method="post">
    <?php if ($endGame != null) { ?>
        <input type="submit" name="doInit" value="Starta nytt spel" class="btn-100">
    <?php } elseif ($currentPlayer === 1) { ?>
            <input type="submit" name="computer" value="Låt datorn kasta" class="btn-100">
            <input type="submit" name="doInit" value="Starta nytt spel" class="btn-100">
    <?php } else { ?>
            <input type="submit" name="rollDices" value="Kasta tärningarna" class="btn-100">
            <input type="submit" name="savePoints" value="Spara poäng" class="btn-100">
            <input type="submit" name="doInit" value="Starta nytt spel" class="btn-100">
    <?php } ?>
</form>

<div class="container">
    <div class="w50">
        <?php if ($lastPlayer === 0 || $lastPlayer === 1) { ?>
            <h3><?= $name[$lastPlayer] ?>s senaste kast: </h3>
        <?php } ?>

        <?php if ($lastValues != null) { ?>
            <?php for ($i = 0; $i < count($lastValues); $i++) { ?>
                <i class="dice-sprite dice-<?= $lastValues[$i] ?>"></i>
            <?php } ?>
            <p>Sammanlagd poäng: <?= $lastPoints ?></p>
        <?php } ?>
    </div>
    <div class ="w50">
        <h3>Aktuell spelställning:</h3>
        <p><?= $name[0]?>: <?= $playerPoints?> <br> <?= $name[1]?>: <?= $computerPoints?></p>
    </div>
</div>

<div class="container">
    <div class="w100">
        <?php if ($lastPlayer === 0 || $lastPlayer === 1) { ?>
        <h3><?= $name[$lastPlayer] ?>s tidigare tärningskast</h3>
        <pre><?= $lastHistogram->getAsText() ?></pre>
        <?php } ?>
    </div>
</div>

<!-- <?php include("debug.php") ?> -->
