<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>

<body>

    <?php

    require_once("../bdInit.php");
    session_start();

    if (isset($_SESSION['nom']) && isset($_SESSION['ident'])) {
        header('location:' . $_SERVER['HTTP_REFERER']);
    }
    if (isset($_POST['id']) && isset($_POST['mdp'])) {
        $sql = "SELECT * FROM user WHERE (user.user_id=? and user.password=?)";
        $query = $pdo->prepare($sql);
        if ($query->execute([$_POST['id'], $_POST['mdp']])) {
            if ($row = $query->fetch()) {
                $_SESSION['nom'] = $row['name'];
                $_SESSION['ident'] = $row['id'];    
                var_dump($_SESSION);
                if (isset($_SESSION['precedentePage'])) {
                    $precedentePage = $_SESSION['precedentePage'];
                    var_dump($_SESSION);
                    unset($_SESSION['precedentePage']);
                    echo $precedentePage;
                    header('location:' .  $precedentePage);
                } else{
                    header('location:' . $_SERVER['HTTP_REFERER']);
                }
            }
        }
    }else if (!isset($_SESSION['precedentePage'])) {
        $_SESSION['precedentePage'] = $_SERVER['HTTP_REFERER'];
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