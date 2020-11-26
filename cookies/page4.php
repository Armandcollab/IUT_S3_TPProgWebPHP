<?php
require_once("sessionStart.php");
require_once("../bdInit.php");
session_start();
?>
<h2>Connecté en tant que : <?= $_SESSION['nom'] ?> </h2>
<h1>Page 4 privée</h1>
<ul>
    <li><a href="page1.php">page1</a></li>
    <li><a href="page2.php">page2</a></li>
    <li><a href="page3.php">page3</a></li>
    <li><a href="page4.php">page4</a></li>
    <li><a href="../series.php">Series</a></li>
</ul>
<?php
    $sql = 'SELECT COUNT(*) FROM user_series WHERE user_id LIKE '. $_SESSION['ident'];
    $query = $pdo->query($sql);
    echo "Tu suis " .(int)$query->fetch(). " séries";
?>
<br>
<a href="deconnexion.php">Deconnexion</a>