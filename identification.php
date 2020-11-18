<?php
session_start();
?>
<form action="identification.php" method="post">
    <?= " Identifiant ";?>
    <input type="text" name="id" />
    <?= " Mots de passe ";?>
    <input type="text" name="mdp" />
    <input type="submit" id="calculer" value="OK">
<form>