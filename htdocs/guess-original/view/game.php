<main>

    <h1>Guess the number</h1>

    <p>Guess a number between 1 and 100, you have <?= $tries ?> tries left</p>

    <form method="post">
        <input type="text" name="guess">
        <input type="hidden" name="number" value="<?= $number ?>">
        <input type="hidden" name="tries" value="<?= $tries ?>">
        <input type="submit" name="doGuess" value="Make a guess" <?= ($tries === 0) ? "disabled" : "" ?> >
        <input type="submit" name="doInit" value="Start new game">
        <input type="submit" name="doCheat" value="Cheat">
    </form>

    <?php if ($doGuess) : ?>
        <?php if ($res === "CORRECT!") : ?>
            <h2>Your guess <?= $guess ?> is <?= $res ?> </h2>
        <?php else : ?>
            <p>Your guess <?= $guess ?> is <strong> <?= $res ?> </strong></p>
        <?php endif ; ?>
    <?php endif ; ?>

    <?php if ($doCheat) : ?>
        <p>CHEAT: Current number is <?= $number ?> </p>
    <?php endif ; ?>

</main>
