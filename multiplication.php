<?php
$nbr = 9;
$nbr2 = 9;
$table = '<table>';
for ($a = 1; $a <= $nbr; $a++) {
    $table .= '<tr>';
    for ($b = 1; $b <= $nbr2; $b++) {
        if ($a * $b == $a or $a * $b == $b) {
            $table .= '<td><b>' . $a * $b . '</b></td>';
        } else if (intval($_GET['a']) == $a or intval($_GET['b']) == $b) {
            $table .= '<td><span style="background:#FFFF00"><a href=multiplication.php?b=' . $b . '&a=' . $a . '>' . $a * $b . '</a></span></td>';
        } else {
            $table .= '<td><a href=multiplication.php?b=' . $b . '&a=' . $a . '>' . $a * $b . '</a></td>';
        }
    }
    $table .= '</tr>';
}
$table .= '</table>';
echo $table;
