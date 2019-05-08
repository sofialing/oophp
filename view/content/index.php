<?php
namespace Anax\View;

if (!$res) {
    return;
}

require "nav.php";
?>

<h1><?= $heading ?></h1>


<table>
    <tr class="first">
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
        <th>Path</th>
        <th>Slug</th>
        <th>Published</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Deleted</th>
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
            <td><a href="<?= url("content/edit/$content->id") ?>"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a></td>
        <?php endif; ?>
    </tr>
<?php endforeach; ?>
</table>
