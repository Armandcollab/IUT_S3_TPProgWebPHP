<?= "Liste des séries commencant par " . $_GET["initiale"] ?>

<ol>
    <?php

    $dsn = "mysql:dbname=etu_aclaveau;host=127.0.0.1";
    $user = "aclaveau";
    $password = "aclaveau";
    $pdo =
        new PDO($dsn, $user, $password);
    $pdo->query('SET CHARSET UTF8');
    $cpt = 0;

    class Series
    {
        protected $id;
        protected $title;
        protected $poster;
        public function __get($name)
        {
            return $this->{$name};
        }
    };

    $sql = "SELECT * FROM `series` WHERE title LIKE ?";
    $query = $pdo->prepare($sql);
    if ($query->execute([$_GET["initiale"] . "%"])) {
        $query->setFetchMode(PDO::FETCH_CLASS, 'Series');
        while ($serie = $query->fetch()) {
            ?>
            <li> <?= $serie->title ?> </li>
            <?php
            echo '<img src="data:image/jpeg;base64,' . base64_encode($serie->poster) . '" />';
        }
    } else {
        var_dump($pdo->errorInfo());
    }
    ?>

</ol>