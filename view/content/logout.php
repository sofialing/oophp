<?php
namespace Anax\View;

?>

<h1>Du är inloggad som: <?= $app->session->get('user') ?>. <br> Vill du logga ut?</h1>

<form method="post">
    <fieldset>
        <input type="submit" name="logout" value="Logga ut">
    </fieldset>
</form>

<p><a href="<?= url("content") ?>">Tillbaka</a></p>
