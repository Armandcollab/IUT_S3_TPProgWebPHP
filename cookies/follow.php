<?php
require_once("sessionStart.php");
require_once("../bdInit.php");
session_start();

$sql = "INSERT INTO `user_series`(`user_id`, `series_id`) VALUES (?,?)";
$query = $pdo->prepare($sql);
$query->execute([$_SESSION['ident'],$_GET["id"]]);

header('Location: ' . $_SERVER['HTTP_REFERER']);
