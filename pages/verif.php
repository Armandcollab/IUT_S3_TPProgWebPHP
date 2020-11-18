<?php
require_once("../bdInit.php");

if (isset($_POST['id']) && isset($_POST['mdp'])) {
    $sql = "SELECT * FROM user WHERE (user.user_id=? and user.password=?)";
    $query = $pdo->prepare($sql);
    if ($query->execute([$_POST['id'], $_POST['mdp']])) {
        if ($row = $query->fetch()) {
            session_start();
            $_SESSION['nom'] = $row['name'];
            $_SESSION['ident'] = $row['id'];
            header('location:page1.php');
        } else {
            header('Location:connexion.html');
        }
    }
}
