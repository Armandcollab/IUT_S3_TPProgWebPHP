<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription nouvelle utilisateur</title>
</head>

<body>
    <?php

    require_once("bdInit.php");

    if ($_POST['nom'] == null) { ?>
        <form action="nouveau.php" method="post">
            Nom :
            <input type="text" name="nom" />
            Email :
            <input type="text" name="email" />
            Identifiant :
            <input type="text" name="id" />
            Mot de passe :
            <input type="text" name="mdp" />
            Pays :
            <select type="text" name="pays" id="pays_select">
                <option value="">--Choisir une option--</option>
                <?php

                $sql = "SELECT * FROM `country`";
                $query = $pdo->query($sql);

                while ($pays = $query->fetch()) {
                    echo '<option value="' . $pays[0] . '">' . $pays[1] . '</option>';
                }

                ?>
            </select>
            <input type="text" placeholder="Autre..." name="autrePays" />
            <input type="submit" id="Enregistrer" value="Enregistrer">




        </form>
    <?php } else {

        $sql = "INSERT INTO `user`( `name`, `email`, `password`,`country_id` ,`user_id`)
    VALUES (? ,? ,? ,?, ?)";
        $query = $pdo->prepare($sql);
        $pays = (int) $_POST['pays'];

        if ($_POST['autrePays'] != null){
            var_dump($_POST['autrePays']);
            $sqlPays = 'INSERT INTO `country`(`name`) VALUES (?)';
            $queryPays = $pdo->prepare($sqlPays);
            $queryPays->execute([$_POST['autrePays']]);
            $pays = (int) $pdo->lastInsertId();
        }

        $query->execute([$_POST['nom'], $_POST['email'], $_POST['mdp'],$pays, $_POST['id']]);


        echo "nouvelle utilisateur crée <br>";
        echo '<a href="accueil.php">Retour</a>';
    }

    ?>
</body>

</html>