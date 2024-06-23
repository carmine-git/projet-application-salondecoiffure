<?php
// Merci de changer les données qui correspondent à votre environnement

$hostname = "";
$database = "";
$username = '';
$password = "";
$port = 3306;

try {
    $connexion = new mysqli($hostname, $username, $password, $database, $port);
} catch (PDOexception $e) {
    echo 'Connection failed: ' . $e->getMessage();
};
