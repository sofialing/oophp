<h1>Uppdatera film "<?= $resultset->title ?>"</h1>

<form method="post">
    <fieldset>
    <input type="hidden" name="movieId" value="<?= $resultset->id ?>"/>

        <label>Titel:</label>
        <input type="text" name="movieTitle" value="<?= $resultset->title ?>"/>
        <br>

        <label>Årtal:</label>
        <input type="number" name="movieYear" value="<?= $resultset->year ?>"/>
        <br>

        <label>Bild:</label>
        <input type="text" name="movieImage" value="<?= $resultset->image ?>"/>
        <br>

        <input type="submit" name="doSave" value="Spara">
        <input type="reset" value="Återställ">
    </fieldset>
</form>

<a href="../movie">Tillbaka till alla filmer</a>
