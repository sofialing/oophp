<?php
namespace Anax\View;

if (!$res) {
    return;
}

require "nav.php";
?>

<table>
    <tr class="first">
        <th>Id</th>
        <th>Title</th>
        <th>Type</th>
        <th>Status</th>
        <th>Published</th>
        <th>Deleted</th>
    </tr>
<?php $id = -1; foreach ($res as $content) :
    $id++; ?>
    <tr>
        <td><?= $content->id ?></td>
        <td><a href="<?= url("content/page/$content->path") ?>"><?= $content->title ?></a></td>
        <td><?= $content->type ?></td>
        <td><?= $content->status ?></td>
        <td><?= $content->published ?></td>
        <td><?= $content->deleted ?></td>
    </tr>
<?php endforeach; ?>
</table>
