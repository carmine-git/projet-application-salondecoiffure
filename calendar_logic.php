<?php

use PDOException;

enum env
{
    case dev;
    case production;
}

$env = env::dev;

if ($env === env::dev) {
    $host = "localhost";
    $db = "barber";
    $user = "talal";
    $password = "";
} else {
    $host = "192.168.121.0";
    $db_name = "barber";
    $db_user = "talal";
    $password = "";
};


$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage());
};

// Obtenir la date d'aujourd'hui dynamiquement
$currentDate = isset($_GET['date']) ? new DateTime($_GET['date']) : new DateTime();
