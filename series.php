<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Séries</title>
</head>

<body>
    <form action="" method="get">
        L'initiale de la série recherché
        <input type="text" name="initiale" />
        <input type="submit" id="calculer" value="calculer">
    </form>

    <ol>
        <?php

        require_once("bdInit.php");
        require_once("classeSerie.php");

        $initale = $_GET['initiale'];
        $nbrSerieParPage = 10;
        $page = ($_GET['page'] != null ? (int)$_GET['page'] : 1);

        
        //LIENS PAGES BOUTTONS
        $lienPage = "?";
        if ($initale != null)
            $lienPage = $lienPage . "initiale=" . $initale . "&";
        $pagePrecedente = $lienPage . "page=" . ($page - 1);
        $pageSuivante = $lienPage . "page=" . ($page + 1);


        //DEBUT CONSTRUCTION REQUETTE
        $sql = " FROM `series` ";

        if ($initale != null) {
            $sql = $sql . 'WHERE title LIKE ?';
            echo 'Liste des séries commencant par ' . $initale;
            echo '<br>';
        }

        //REQUETTE POUR PAGES MAX
        $sqlMAX = "SELECT COUNT(*) " . $sql;
        if ($initale != null) {
            $queryMAX = $pdo->prepare($sqlMAX);
            $queryMAX->execute([$initale . "%"]);
        } else {
            $queryMAX = $pdo->query($sqlMAX);
        }
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
        if ($query->execute([$initale . "%"])) {

            $query->setFetchMode(PDO::FETCH_CLASS, 'Series');
            while ($serie = $query->fetch()) {
                echo '<a href="serie.php?titre=' . $serie->title . '"><li>' . $serie->title . '</li>';
                echo '<img src="data:image/jpeg;base64,' . base64_encode($serie->poster) . '" /></a>';
            }
        } else {
            var_dump($pdo->errorInfo());
        }

        ?>

    </ol>
</body>

</html>