<?php
require_once("bdInit.php");
require_once("classeSerie.php");
session_start();

//Bouton retour
echo '<a href="'.$_SERVER['HTTP_REFERER'].'">Retour</a>';

$sql = "SELECT * FROM `series` WHERE title LIKE ?";
$query = $pdo->prepare($sql);
if ($query->execute([$_GET["titre"]])) {
    $query->setFetchMode(PDO::FETCH_CLASS, 'Series');
    while ($serie = $query->fetch()) {
        // titre
        echo '<h1>' . $serie->title . '</h1>';
        // suivre / se connecter
        if (isset($_SESSION['nom'])) {
            $sql = "SELECT COUNT(*) FROM `user_series` WHERE `user_id` LIKE ? AND `series_id` LIKE ?";
            $query = $pdo->prepare($sql);
            $query->execute([$_SESSION['ident'], $serie->id]);
            $suivi = $query->fetch();
            if ($suivi[0] == 1) {
                echo '<a href="cookies/unfollow.php?id=' . $serie->id . '">Ne plus suivre</a>';
            } else {
                echo '<a href="cookies/follow.php?id=' . $serie->id . '">Suivre </a>';
            }
        } else {
            echo '<a href="cookies/connexion.html">Se connecter pour pouvoir suivre</a>';
        }
        echo '<br>';
        // image
        echo '<img src="data:image/jpeg;base64,' . base64_encode($serie->poster) . '" />';

        // list saisons
        echo '<ul>';

        $sql = "SELECT season.id AS idSeason, season.number as number, ( SELECT COUNT(*) FROM episode WHERE episode.season_id = idSeason ) as nbrEpisode FROM season INNER JOIN episode ON episode.season_id = season.id WHERE season.series_id = ? GROUP BY number";
        $query = $pdo->prepare($sql);
        if ($query->execute([$serie->id])) {
            while ($season = $query->fetch()) {
                echo '<li> Saison ' . $season['number'] . ' (' . $season['nbrEpisode'] . ' épisodes) </li>';
            }
        }
        echo '</ul>';
    }
} else {
    var_dump($pdo->errorInfo());
}
