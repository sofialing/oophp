<h1>Lägg till ny film</h1>

<form method="post">
    <fieldset>
    <input type="hidden" name="route" value="add"/>

        <label>Titel:</label>
        <input type="text" name="movieTitle">
        <br>

        <label>Årtal:</label>
        <input type="number" name="movieYear" placeholder="ÅÅÅÅ">
        <br>

        <label>Bild:</label>
        <input type="text" name="movieImage" value="image/no-image.jpg">
        <br>

        <input type="submit" name="doSave" value="Spara">
        <input type="reset" value="Återställ">
    </fieldset>
</form>

<a href="../movie">Tillbaka till alla filmer</a>
