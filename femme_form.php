<?php
session_start();
require_once "mysqli.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $coupe = $_POST['coupe'];
    $couleur = $_POST['couleur'];
    $sexe = "femme";
    $prix = "5€";
    $client_id = $_SESSION['client_id'];

    $query = "INSERT INTO coiffures_client (client_id, sexe, coupe, prix)
              VALUES (?, ?, ?, ?)";
    $st = $connexion->prepare($query);
    $st->bind_param("ssss", $client_id, $sexe, $coupe, $prix);

    try {
        $st->execute();
    } catch (Exception $e) {
        echo 'Statement failed to prepare: ' . $query .  $e->getMessage();
    } finally {
        $st->close();
        $connexion->close();
    }

    header("location: viewitems.php");
}
