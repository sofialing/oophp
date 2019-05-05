<?php

namespace Anax\View;

/**
 * Render the page for 'movie database
 */

if (!$resultset) {
    return;
}
?>

<h1>Visar sökresultat för "<?= $search ?>"</h1>

<table>
    <tr class="first">
        <th>Id</th>
        <th width="250px">Bild</th>
        <th>Titel</th>
        <th>År</th>
        <th colspan="2"></th>
    </tr>
<?php $id = -1; foreach ($resultset as $movie) :
    $id++; ?>
    <tr>
        <td><?= $movie->id ?></td>
        <td><img src="../../<?= $movie->image ?>&w=200&crop-to-fit&aspect-ratio=16:10"></td>
        <td><?= $movie->title ?></td>
        <td><?= $movie->year ?></td>
        <td><a href="<?= url("movie/edit/$movie->id") ?>"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a></td>
        <td><a href="<?= url("movie/delete/$movie->id") ?>"><i class="fas fa-trash" aria-hidden="true"></i></a></td>
    </tr>
<?php endforeach; ?>
</table>

<?php require "search-field.php"; ?>

<a href="<?= url("movie/") ?>">Tillbaka till alla filmer</a> | <a href="<?= url("movie/add") ?>">Lägg till ny film</a>
