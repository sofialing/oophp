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
        <th><?= orderby("id", $defaultRoute) ?> <br> Id</th>
        <th><?= orderby("title", $defaultRoute) ?> <br> Title</th>
        <th><?= orderby("type", $defaultRoute) ?> <br> Type</th>
        <th><?= orderby("path", $defaultRoute) ?> <br> Path</th>
        <th><?= orderby("slug", $defaultRoute) ?> <br> Slug</th>
        <th><?= orderby("published", $defaultRoute) ?> <br> Published</th>
        <th><?= orderby("created", $defaultRoute) ?> <br> Created</th>
        <th><?= orderby("updated", $defaultRoute) ?> <br> Updated</th>
        <th><?= orderby("deleted", $defaultRoute) ?> <br> Deleted</th>
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
