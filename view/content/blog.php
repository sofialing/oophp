<?php
namespace Anax\View;

if (!$res) {
    return;
}

require "nav.php";
$format = new \Soln\MyTextFilter\MyTextFilter();
?>


<article>

    <?php foreach ($res as $content) : ?>
    <section>
        <header>
            <h1><a href="<?= url("blog/show-post/$content->slug") ?>"><?= esc($content->title) ?></a></h1>
            <p><i>Published: <time datetime="<?= esc($content->published_iso8601) ?>" pubdate><?= esc($content->published) ?></time></i></p>
        </header>
        <?= $format->parse($content->data, "link,nl2br") ?>
    </section>
    <?php endforeach; ?>

</article>
