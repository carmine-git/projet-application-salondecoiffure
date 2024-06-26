<?php
require_once "mysqli.php";

session_start();
session_regenerate_id(true);

$session_id = session_id();
$user_id = uniqid();
$accountCreationDate = date('d/m/Y H:i');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];
    $confirmemdp = $_POST['confirmemdp'];

    if ($mdp !== $confirmemdp) {
        echo "les mots de passe ne correspondent pas";
    }

    $mdp = hash('sha256', $mdp);

    try {
        $query = "INSERT INTO comptes_client (
                    client_id, 
                    nom, 
                    prenom, 
                    email, 
                    mdp,
                    date_inscription, 
                    session_id
                ) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $st = $connexion->prepare($query);
        $st->bind_param("sssssss", $user_id, $nom, $prenom, $email, $mdp, $accountCreationDate, $session_id);
        $st->execute();
        $st->close();
    } catch (mysqli_sql_exception $e) {
        echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
    };

    $_SESSION['email'] = $email;
    $_SESSION['user_id'] = $user_id;
    $_SESSION['prenom'] = $prenom;
    $connexion->close();

    header('location: login.html');
} else {
    header("Location: login.html");
    exit;
};
