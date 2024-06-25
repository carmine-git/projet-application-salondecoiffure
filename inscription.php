<?php
require_once "mysqli.php";

session_start();
session_regenerate_id(true);
$session_id = session_id();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $confirmemdp = $_POST['confirmemdp'];

    // Nous nous assurons que la tables des comptes client est crée même la base de donnée est nouvelle
    $clientAccountTableExists = $connexion->prepare("SELECT 1 FROM comptes_client LIMIT 1");
    if ($clientAccountTableExists !== 1) {
        $connexion->prepare("CREATE TABLE `comptes_client` (
            `client_id` int NOT NULL,
            `nom` varchar(32) NOT NULL,
            `prenom` varchar(32) NOT NULL,
            `email` varchar(100) NOT NULL,
            `mdp` varchar(255) NOT NULL,
            `date_inscription` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
            )");
    };

    if ($mdp !== $confirmemdp) {
        echo "les mots de passe ne correspondent pas";
    }

    $hashedPassword = hash('sha256', $mdp);

    try {
        $query = "INSERT INTO comptes_client (nom, prenom, email, mdp, session_id) VALUES (?, ?, ?, ?, ?)";
        $st = $connexion->prepare($query);
        $st->bind_param("sssss", $nom, $prenom, $email, $hashedPassword, $session_id);
        $st->execute();
        $st->close();
    } catch (mysqli_sql_exception $e) {
        echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
    };

    $_SESSION['email'] = $email;
    $_SESSION['nom'] = $nom;
    $_SESSION['prenom'] = $prenom;
    $connexion->close();

    header("location: login.html");
} else {
    header("Location: login.html");
    exit;
};
