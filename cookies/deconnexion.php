<?php
require_once("sessionStart.php");
session_destroy();

header('Location:'.$_SERVER['HTTP_REFERER']);
