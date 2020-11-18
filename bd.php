<?= "Liste des séries commencant par " . $_GET["initiale"] ?>

<ol>
    <?php

    require_once("bdInit.php");
    require_once("classeSerie.php");


    $sql = "SELECT * FROM `series` WHERE title LIKE ?";
    $query = $pdo->prepare($sql);
    if ($query->execute([$_GET["initiale"] . "%"])) {
        $query->setFetchMode(PDO::FETCH_CLASS, 'Series');
        while ($serie = $query->fetch()) {
            echo '<li><a href="serie.php?titre=' . $serie->title . '">' . $serie->title . '</a></li>';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($serie->poster) . '" />';
        }
    } else {
        var_dump($pdo->errorInfo());
    }
    ?>

</ol>