<?php
namespace Anax\View;

require "nav.php";
$format = new \Soln\MyTextFilter\MyTextFilter();
?>

<article class="blog">
    <header>
        <h1><?= esc($content->title) ?></h1>
        <p><i>Publiserad: <time datetime="<?= esc($content->published_iso8601) ?>" pubdate><?= esc($content->published) ?></time></i></p>
    </header>
    <?= $format->parse($content->data, $content->filter) ?>
</article>

<p><a href="<?= url("blog") ?>">Tillbaka</a></p>
