<?php
// Informations de connexion à la base de données
// $serveur = "localhost";
// $utilisateur = "root";
// $mot_de_passe = "V!nc3nt/3t/s0n/C0mpt3@MysSQL";
// $base_de_donnees = "serveur_database";
// mdpcrypte = "$2y$10$j48nLTi6uainwbWTYc46D.I37hHMEUDJDcZEVBnoM3TZauJSjpb2O";
// Connexion à la base de données

$dsn = 'mysql:host=localhost;dbname=serveur_database';
$username= 'root';
$password="V!nc3nt/3t/s0n/C0mpt3@MysSQL";

try {
    $connexion = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connecté!!";
} catch (PDOexception $e) {
    echo 'Connection failed: ' . $e->getMessage();
};