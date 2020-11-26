<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>

<body>

    <?php

    require_once("../bdInit.php");

    if (isset($_SESSION['nom']) && isset($_SESSION['ident']))
        if (isset($_POST['id']) && isset($_POST['mdp'])) {
            $sql = "SELECT * FROM user WHERE (user.user_id=? and user.password=?)";
            $query = $pdo->prepare($sql);
            if ($query->execute([$_POST['id'], $_POST['mdp']])) {
                if ($row = $query->fetch()) {
                    session_start();
                    $_SESSION['nom'] = $row['name'];
                    $_SESSION['ident'] = $row['id'];
                    if (isset($_POST['HTTP_REFERER']))
                        header('location:' . $_POST['HTTP_REFERER']);
                    else
                        header('location:' . $_SERVER['HTTP_REFERER']);
                }
            }
        }
    ?>



    <form action="" method="post">
        Identifiant:
        <input type="text" name="id" />
        Mots de passe:
        <input type="text" name="mdp" />
        <input type="submit" id="connexion" value="OK">
    </form>
    <br>
    <a href="../accueil.php">Accueil</a>
</body>

</html>