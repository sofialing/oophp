<?php
namespace Anax\View;

require "nav.php";
?>

<article>
    <header>
        <h1><?= esc($content->title) ?></h1>
        <p><i>Publiserad: <time datetime="<?= esc($content->published_iso8601) ?>" pubdate><?= esc($content->published) ?></time></i></p>
    </header>
    <?= esc($content->data) ?>
</article>
