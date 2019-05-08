<?php
namespace Anax\View;

?>

<h1>Du måste vara inloggad för att göra ändringar i databasen.</h1>

<form method="post">
    <fieldset>

        <label>Användarnamn:</label>
        <input type="text" name="user">
        <br>

        <label>Lösenord:</label>
        <input type="password" name="pass">
        <br>

        <input type="submit" name="login" value="Logga in">
    </fieldset>
</form>

<p><a href="<?= url("content") ?>">Tillbaka</a></p>
