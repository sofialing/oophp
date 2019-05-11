<?php
namespace Anax\View;

if (!$res) {
    return;
}

require "nav.php";
$format = new \Soln\MyTextFilter\MyTextFilter();
?>

<pre>
    <?php var_dump($res) ?>
</pre>

<article>

<?php if (is_array($res)) : ?>
    <?php foreach ($res as $content) : ?>
    <section>
        <header>
            <h1><a href="<?= url("content/blog/$content->slug") ?>"><?= esc($content->title) ?></a></h1>
            <p><i>Published: <time datetime="<?= esc($content->published_iso8601) ?>" pubdate><?= esc($content->published) ?></time></i></p>
        </header>
        <?= $format->parse($content->data, $content->filter) ?>
    </section>
    <?php endforeach; ?>
<?php else : ?>
    <header>
        <h1><?= esc($res->title) ?></h1>
        <p><i>Publiserad: <time datetime="<?= esc($res->published_iso8601) ?>" pubdate><?= esc($res->published) ?></time></i></p>
    </header>
    <?= $format->parse($res->data, $res->filter) ?>
    <p><a href="<?= url("content/blog") ?>">Alla inlägg</a></p>
<?php endif; ?>

</article>
