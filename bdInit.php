<?php
$dsn = "mysql:dbname=etu_aclaveau;host=127.0.0.1";
$user = "aclaveau";
$password = "aclaveau";
$pdo = new PDO($dsn, $user, $password);
$pdo->query('SET CHARSET UTF8');
