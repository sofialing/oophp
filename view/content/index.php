<?php
namespace Anax\View;

if (!$res) {
    return;
}

$defaultRoute = "content?";
require "nav.php";
?>

<h1><?= $heading ?></h1>

<table class="content-table">
    <tr class="first">
        <th style="width:50px">Id <br> <?= orderby("id", $defaultRoute) ?></th>
        <th>Title <br> <?= orderby("title", $defaultRoute) ?></th>
        <th>Type <br> <?= orderby("type", $defaultRoute) ?></th>
        <th>Path <br> <?= orderby("path", $defaultRoute) ?></th>
        <th>Slug <br> <?= orderby("slug", $defaultRoute) ?></th>
        <th>Published <br> <?= orderby("published", $defaultRoute) ?></th>
        <th>Created <br> <?= orderby("created", $defaultRoute) ?></th>
        <th>Updated <br> <?= orderby("updated", $defaultRoute) ?></th>
        <th>Deleted <br> <?= orderby("deleted", $defaultRoute) ?></th>
        <th></th>
    </tr>
<?php $id = -1; foreach ($res as $content) :
    $id++; ?>
    <tr>
        <td><?= $content->id ?></td>
        <td><?= $content->title ?></td>
        <td><?= $content->type ?></td>
        <td><?= $content->path ?></td>
        <td><?= $content->slug ?></td>
        <td><?= $content->published ?></td>
        <td><?= $content->created ?></td>
        <td><?= $content->updated ?></td>
        <td><?= $content->deleted ?></td>
        <?php if ($app->session->get('user')) : ?>
            <td><a href="<?= url("content/edit/$content->id") ?>"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a>
        <?php endif; ?>
    </tr>
<?php endforeach; ?>
</table>

<p>
    Sidor:
    <?php for ($i = 1; $i <= $max; $i++) : ?>
        <a href="<?= mergeQueryString(["page" => $i], $defaultRoute) ?>"><?= $i ?></a>
    <?php endfor; ?>
</p>
