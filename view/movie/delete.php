<h1>Radera film "<?= $resultset->title ?>"</h1>

<form method="post">
    <fieldset>
    <input type="hidden" name="movieId" value="<?= $resultset->id ?>">

        <label>Titel:</label>
        <input type="text" name="movieTitle" value="<?= $resultset->title ?>" readonly>
        <br>

        <label>Årtal:</label>
        <input type="number" name="movieYear" value="<?= $resultset->year ?>" readonly>
        <br>

        <label>Bild:</label>
        <input type="text" name="movieImage" value="<?= $resultset->image ?>" readonly>
        <br>

        <input type="submit" name="doDelete" value="Radera">
    </fieldset>
</form>

<a href="../movie">Tillbaka till alla filmer</a>
