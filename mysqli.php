<?php
$hostname = "localhost";
$database = "serveur_database";
$username = 'root';
$password = "V!nc3nt/3t/s0n/C0mpt3@MySQL";
$port = 3306;

try {
    $connexion = new mysqli($hostname, $username, $password, $database, $port);
} catch (PDOexception $e) {
    echo 'Connection failed: ' . $e->getMessage();
};
