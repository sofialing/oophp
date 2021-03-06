<?php
namespace Anax\View;

if (!$res) {
    return;
}

require "nav.php";
?>

<h1>Uppdatera innehåll "<?= $res->title ?>"</h1>

<form method="post">
    <fieldset>
    <input type="hidden" name="contentId" value="<?= $res->id ?>">

        <label>Titel:</label>
        <input type="text" name="contentTitle" value="<?= $res->title ?>">
        <br>

        <label>Path:</label>
        <input type="text" name="contentPath" value="<?= $res->path ?>">
        <br>

        <label>Slug:</label>
        <input type="text" name="contentSlug" value="<?= $res->slug ?>">
        <br>

        <label>Text:</label>
        <textarea name="contentData"><?= $res->data ?></textarea>
        <br>

        <label>Typ:</label>
        <input type="text" name="contentType" value="<?= $res->type ?>">
        <br>

        <label>Filter:</label>
        <input type="text" name="contentFilter" value="<?= $res->filter ?>">
        <br>

        <label>Publiserad:</label>
        <input type="datetime" name="contentPublish" value="<?= $res->published ?>">
        <br>

        <input type="submit" name="doSave" value="Spara">
        <?php if ($res->deleted === null) : ?>
            <input type="submit" name="doDelete" value="Radera">
        <?php else : ?>
            <input type="submit" name="undoDelete" value="Återskapa">
        <?php endif; ?>
        <input type="reset" value="Återställ">
    </fieldset>
</form>

<p><a href="<?= url("content") ?>">Tillbaka</a></p>
