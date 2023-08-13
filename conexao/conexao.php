<?php

$host = "localhost";
$db = "crud_cliente";
$user = "root";
$pass = "";

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_errno) {
    die("Falha no conexão com o banco de dadoss" . $mysqli->connect_error);
}
