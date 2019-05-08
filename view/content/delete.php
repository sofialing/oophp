<?php
namespace Anax\View;

require "nav.php";

?>

<h1>Vill du radera sidan "<?= esc($content->title) ?>"?</h1>

<form method="post">
    <fieldset>
        <input type="submit" name="doDelete" value="Radera">
    </fieldset>
</form>

<p><a href="<?= url("content") ?>">Tillbaka</a></p>
