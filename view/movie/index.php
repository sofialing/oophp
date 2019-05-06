<?php

namespace Anax\View;

/**
 * Render the page for 'movie database
 */

if (!$resultset) {
    return;
}

$defaultRoute = "movie?"

?>

<h1>Filmdatabas</h1>

<p>Filmer per sida:
    <a href="<?= mergeQueryString(["hits" => 2], $defaultRoute) ?>">2</a> |
    <a href="<?= mergeQueryString(["hits" => 4], $defaultRoute) ?>">4</a> |
    <a href="<?= mergeQueryString(["hits" => 8], $defaultRoute) ?>">8</a>
</p>

<table>
    <tr class="first">
        <th>Id <?= orderby("id", $defaultRoute) ?></th>
        <th width="250px">Bild</th>
        <th>Titel <?= orderby("title", $defaultRoute) ?></th>
        <th>År <?= orderby("year", $defaultRoute) ?></th>
        <th colspan="2"></th>
    </tr>
<?php $id = -1; foreach ($resultset as $movie) :
    $id++; ?>
    <tr>
        <td><?= $movie->id ?></td>
        <td><img src="<?= $movie->image ?>&w=200&crop-to-fit&aspect-ratio=16:10"></td>
        <td><?= $movie->title ?></td>
        <td><?= $movie->year ?></td>
        <td><a href="<?= url("movie/edit/$movie->id") ?>"><i class="fas fa-pencil-alt" aria-hidden="true"></i></a></td>
        <td><a href="<?= url("movie/delete/$movie->id") ?>"><i class="fas fa-trash" aria-hidden="true"></i></a></td>
    </tr>
<?php endforeach; ?>
</table>

<p>
    Sidor:
    <?php for ($i = 1; $i <= $max; $i++) : ?>
        <a href="<?= mergeQueryString(["page" => $i], $defaultRoute) ?>"><?= $i ?></a>
    <?php endfor; ?>
</p>

<?php require "search-field.php"; ?>


<a href="<?= url("movie/add") ?>">Lägg till ny film</a>
<?php if ($app->session->get('user')) : ?>
    | <a href="<?= url("movie/logout") ?>"> Logga ut</a>
<?php else : ?>
    | <a href="<?= url("movie/login") ?>">Logga in</a>
<?php endif ; ?>
