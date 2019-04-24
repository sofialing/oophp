<?php

namespace Anax\View;

/**
 * Render the page for 'dice game 100'
 */

?>
<h1>Starta nytt spel</h1>

<form method="post">
    <input type="text" name="name" placeholder="Spelarens namn">
    <input type="text" name="dices" placeholder="Välj antal tärningar (1-5)">
    <input type="submit" name="doInit" value="Starta nytt spel" class="btn-100">
</form>
