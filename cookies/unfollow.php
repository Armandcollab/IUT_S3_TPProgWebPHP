<?php
require_once("sessionStart.php");
require_once("../bdInit.php");
session_start();

$sql = "DELETE FROM `user_series` WHERE `user_id` LIKE ? AND `series_id` LIKE ?";
$query = $pdo->prepare($sql);
$query->execute([$_SESSION['ident'],$_GET["id"]]);

header('Location: ' . $_SERVER['HTTP_REFERER']);