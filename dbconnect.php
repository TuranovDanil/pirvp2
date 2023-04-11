<?php

$host = 'localhost';
$database = 'pirvp2';
$user = 'root';
$password = 'QWEasd123';

$mysqli = mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_errno()) {
    echo "Не удалось подключиться к MySQL: " . mysqli_connect_error();
}