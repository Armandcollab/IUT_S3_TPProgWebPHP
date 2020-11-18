<?php
session_start();
//initialisation du joueur
if (isset($_SESSION['Joueur']))
    $_SESSION['Joueur'] = ($_SESSION['Joueur'] + 1) % 2;
else
    $_SESSION['Joueur'] = 0;

//chargement du tableau
if (isset($_SESSION['tableau']) && !($_GET['case'] == -1)) {
    $tableau = $_SESSION['tableau'];
    $tableau[$_GET['case']] = ($_SESSION['Joueur'] == 1 ? 'X' : 'O');
    $_SESSION['tableau'] = $tableau;
} else {
    for ($i = 0; $i < 9; $i++) {
        $tableau[$i] = '<a href="morpion.php?case=' . $i . '">Jouer</a>';
    }
    $_SESSION['tableau'] = $tableau;
}

//création des 9 cases
echo "<TABLE>";
$cpt = 0;
for ($i = 0; $i < 3; $i++) {
    echo '<tr style="border:1px solid black">';
    for ($j = 0; $j < 3; $j++) {
        echo '<td style="border:1px solid black" align="center" width="200px" height="200px">' . $tableau[$cpt++] . '</td>';
    }
}
echo "</TABLE>";

$res = gagner($tableau);
echo $res;
if ($res != '0') {
    echo ($res == '-1' ? "Personne n'as gagné " : "Le joueur " . $res . " a gagné");
    echo '<a href="morpion.php?case=-1">reset</a>';
}

# permet de savoir si un joueur remporte la partie
function gagner($tableau)
{
    $res = '0';

    if ($tableau[0] == 'X' || $tableau[0] == 'O') {
        if ((($tableau[0] == $tableau[3]) && ($tableau[3] == $tableau[6])) ||
            (($tableau[0] == $tableau[1]) && ($tableau[1] == $tableau[2])) ||
            (($tableau[0] == $tableau[4]) && ($tableau[4] == $tableau[8]))
        ) {
            $res = $tableau[0];
        }
    } else if ($tableau[7] == 'X' || $tableau[7] == 'O') {
        if ((($tableau[1] == $tableau[4]) && ($tableau[4] == $tableau[7])) ||
            (($tableau[7] == $tableau[8]) && ($tableau[8] == $tableau[6]))
        ) {
            $res = $tableau[7];
        }
    } else if ($tableau[5] == 'X' || $tableau[5] == 'O') {
        if ((($tableau[2] == $tableau[5]) && ($tableau[5] == $tableau[8])) ||
            (($tableau[4] == $tableau[5])) && ($tableau[5] == $tableau[3])
        ) {
            $res = $tableau[5];
        }
    } else if (($tableau[2] == 'X' || $tableau[2] == 'O') &&
        ($tableau[2] == $tableau[4]) && ($tableau[4] == $tableau[6])
    ) {
        $res = $tableau[2];
    }
    if ($res == '0') {
        $cpt = 0;
        for ($i = 0; $i < 9; $i++) {
            if ($tableau[$i] != 'X' && $tableau[$i] != 'O') {
                $cpt++;
            }
        }
        if ($cpt == 0)
            return -1;
    }
    return ($res);
}
