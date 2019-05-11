<?php
namespace Anax\View;

require "nav.php";
$format = new \Soln\MyTextFilter\MyTextFilter();
?>

<pre>
    <?php var_dump($content) ?>
</pre>

<article>
    <header>
        <h1><?= esc($content->title) ?></h1>
        <p><i>Publiserad: <time datetime="<?= esc($content->published_iso8601) ?>" pubdate><?= esc($content->published) ?></time></i></p>
    </header>
    <?= $format->parse($content->data, $content->filter) ?>
</article>
