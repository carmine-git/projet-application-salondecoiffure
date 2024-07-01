<?php
session_start();
require_once "mysqli.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $coupe_client = $_POST['coupe'];
    $couleur_client = $_POST['couleur'];
    $sexe_client = "femme";
    $coupes = $_SESSION['prestations']['coupe'];
    $couleurs = $_SESSION['prestations']['couleur'];
    $prix_coupe = $coupes[$coupe_client];
    $prix_couleur = $couleurs[$couleur_client];
    $prix_tot = array_sum(array($prix_coupe, $prix_couleur));
    $client_id = $_SESSION['client_id'];
    $id_rdv = null;

    // Retrouver l'id du rendez-vous
    try {
        $query = "SELECT id_rdv FROM agenda WHERE date_rdv = ? AND heure_rdv = ?";
        $st = $connexion->prepare($query);
        $time = $_SESSION['time'];
        var_dump($time, $_SESSION['date']);
        $st->bind_param("ss", $_SESSION['date'], $time);
        $st->execute();
        $res = $st->get_result();
        $row = mysqli_fetch_row($res);
        $id_rdv = $row[0];
    } catch (Exception $e) {
        echo 'Statement failed to prepare: ' . $query .  $e->getMessage();
    }

    try {
        $query = "INSERT INTO coiffures_client (id_rdv, sexe, coupe, prix, client_id, couleur)
        VALUES (?, ?, ?, ?, ?, ?)";
        $st = $connexion->prepare($query);
        $st->bind_param(
            "ississ",
            $id_rdv,
            $sexe_client,
            $coupe_client,
            $prix_tot,
            $client_id,
            $couleur_client
        );
        $st->execute();
    } catch (Exception $e) {
        echo 'Statement failed to prepare: ' . $query .  $e->getMessage();
    } finally {
        $st->close();
        $connexion->close();
    }

    unset($_SESSION['prestations']);
    $_SESSION['prestations_client'] = array(
        "id_rdv" => $id_rdv,
        "sexe_client" => $sexe_client,
        "coupe_client" => $coupe_client,
        "prix_tot" => $prix_tot,
        "couleur_client" => $couleur_client,
    );

    header("location: viewitems.php");
}
