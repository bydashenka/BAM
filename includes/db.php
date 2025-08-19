<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$mysql = new mysqli("localhost", "root", "", "BAM"); 

if ($mysql->connect_error) {
    die("Ошибка подключения: " . $mysql->connect_error);
}

$mysql->set_charset("utf8");
?>