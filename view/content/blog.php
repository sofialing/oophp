<?php
namespace Anax\View;

if (!$res) {
    return;
}

require "nav.php";
?>

<article>

<?php foreach ($res as $content) : ?>
<section>
    <header>
        <h1><a href="<?= url("content/blog/$content->slug") ?>"><?= esc($content->title) ?></a></h1>
        <p><i>Published: <time datetime="<?= esc($content->published_iso8601) ?>" pubdate><?= esc($content->published) ?></time></i></p>
    </header>
    <?= esc($content->data) ?>
</section>
<?php endforeach; ?>

</article>
