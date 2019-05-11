<?php
namespace Anax\View;

require "nav.php";
$format = new \Soln\MyTextFilter\MyTextFilter();
?>

<article>
    <header>
        <h1><?= esc($content->title) ?></h1>
        <p><i>Senast uppdaterad: <time datetime="<?= esc($content->modified_iso8601) ?>" pubdate><?= esc($content->modified) ?></time></i></p>
    </header>
    <?= $format->parse($content->data, $content->filter) ?>
</article>
