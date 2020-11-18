<?php
require_once("bdInit.php");
require_once("classeSerie.php");

$sql = "SELECT * FROM `series` WHERE title LIKE ?";
$query = $pdo->prepare($sql);
if ($query->execute([$_GET["titre"]])) {
    $query->setFetchMode(PDO::FETCH_CLASS, 'Series');
    while ($serie = $query->fetch()) {
        echo '<h1>' . $serie->title . '</h1>';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($serie->poster) . '" />';
        echo '<ul>';
        $sql = "SELECT season.id AS idSeason, season.number as number, ( SELECT COUNT(*) FROM episode WHERE episode.season_id = idSeason ) as nbrEpisode FROM season INNER JOIN episode ON episode.season_id = season.id WHERE season.series_id = ? GROUP BY number";
        $query = $pdo->prepare($sql);
        if ($query->execute([$serie->id])) {
            while ($season = $query->fetch()) {
                echo '<li> Saison ' . $season['number'] .' ('. $season['nbrEpisode'] . ' épisodes) </li>';
            }
        }
        echo '</ul>';
    }
} else {
    var_dump($pdo->errorInfo());
}
