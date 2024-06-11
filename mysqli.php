<?php
$hostname = "localhost";
$database = "test3";
$username = 'root';
$password = "YZ@pqqKfgCUTl&vVh@d&0#4W";
$port = 3306;

try {
    $connexion = new mysqli($hostname, $username, $password, $database, $port);
} catch (PDOexception $e) {
    echo 'Connection failed: ' . $e->getMessage();
};
