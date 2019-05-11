<?php
namespace Anax\View;

?>

<div class="content-nav">
    <a href="<?= url("content") ?>">Visa allt innehåll</a> &#x2f;
    <a href="<?= url("page") ?>">Visa sidor</a> &#x2f;
    <a href="<?= url("blog") ?>">Visa blogg</a> &#x2f;
    <a href="<?= url("content/create") ?>">Lägg till innehåll</a> &#x2f;
    <?php if ($app->session->get('user')) : ?>
        <a href="<?= url("content/logout") ?>">Logga ut</a>
    <?php else : ?>
        <a href="<?= url("content/login") ?>">Logga in</a>
    <?php endif; ?>
</div>
