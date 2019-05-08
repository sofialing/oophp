<?php
namespace Anax\View;

?>

<h1>Lägg till nytt innehåll</h1>

<form method="post">
    <fieldset>
        <label>Titel:</label>
        <input type="text" name="contentTitle" default="Titel">

        <input type="submit" name="doSave" value="Lägg till">
        <input type="reset" value="Återställ">
    </fieldset>
</form>

<p><a href="<?= url("content") ?>">Tillbaka</a></p>
