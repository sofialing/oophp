<h1>Logga ut</h1>

<p>Du är inloggad som: <?php echo $app->session->get('user') ?>. Vill du logga ut?</p>

<form method="post">
    <fieldset>
        <input type="submit" name="logout" value="Logga ut">
    </fieldset>
</form>

<a href="../movie">Tillbaka till alla filmer</a>
