<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Séries Suivit</title>
</head>

<body>
    <a href="../accueil.php">accueil</a>
    <ol>
        <?php

        require_once("sessionStart.php");
        require_once("../classeSerie.php");
        require_once("../bdInit.php");

        $nbrSerieParPage = 10;
        $page = ($_GET['page'] != null ? (int)$_GET['page'] : 1);


        //DEBUT CONSTRUCTION REQUETTE
        $sql = "FROM series INNER JOIN user_series ON series.id = user_series.series_id WHERE user_series.user_id LIKE ?";

        //REQUETTE POUR PAGES MAX
        $sqlMAX = "SELECT COUNT(*) " . $sql;
        $queryMAX = $pdo->prepare($sqlMAX);
        $queryMAX->execute([$_SESSION['ident']]);
        $pageMax = (int)$queryMAX->fetch()[0];
        $pageMax = ceil($pageMax / $nbrSerieParPage);

        //FIN CONSTRUCTION REQUETTE
        $sql = "SELECT * " . $sql;
        $sql = $sql . ' ORDER BY title ASC LIMIT ' . ($page - 1) * $nbrSerieParPage . ', ' . $nbrSerieParPage;


        //BOUTONS
        if ($page - 1 > 0) {
            echo "<a href=" . $pagePrecedente . "><<</a>";
        }
        echo '<b><a href="?page=' . $page . '">' . $page . '</a></b>';
        if ($page < $pageMax) {
            echo "<a href=" . $pageSuivante . ">>></a>";
        }


        //REQUTTE
        $query = $pdo->prepare($sql);
        $query->execute([$_SESSION['ident']]);

        $query->setFetchMode(PDO::FETCH_CLASS, 'Series');
        while ($serie = $query->fetch()) {
            echo '<li><a href="../serie.php?titre=' . $serie->title . '">' . $serie->title . '</li>';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($serie->poster) . '" /></a>';
        }

        ?>

    </ol>
</body>

</html>
</body>

</html>