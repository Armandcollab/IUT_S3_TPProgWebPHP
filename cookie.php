<?php
session_start();

echo "Je t'ai vu  " . $_SESSION['nbrVue'] . " fois!";
$_SESSION['nbrVue'] = $_SESSION['nbrVue'] + 1;
