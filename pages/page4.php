<?php
require_once("sessionStart.php");
?>
<h2>Connecté en tant que : <?= $_SESSION['nom'] ?> </h2>
<h1>Page 4 privée</h1>
<ul>
    <li><a href="page1.php">page1</a></li>
    <li><a href="page2.php">page2</a></li>
    <li><a href="page3.php">page3</a></li>
    <li><a href="page4.php">page4</a></li>
</ul>

<a href="deconnexion.php">Deconnexion</a>