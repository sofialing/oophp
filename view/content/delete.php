<?php
namespace Anax\View;

?>

<h1>Radera innehåll</h1>

<form method="post">
    <fieldset>
        <label>Titel:</label>
        <input type="text" name="contentTitle" value="<?= esc($content->title) ?>" readonly>

        <input type="submit" name="doDelete" value="Radera">
    </fieldset>
</form>

<p><a href="<?= url("content") ?>">Tillbaka</a></p>
