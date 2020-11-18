<?php
require_once("sessionStart.php");
unset($_SESSION['nom']);
unset($_SESSION['ident']);

header('Location:connexion.html');
