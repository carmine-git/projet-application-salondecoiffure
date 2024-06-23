<?php
// Inclure le fichier d'initialisation de la connexion à la base de données
require_once('mysqli.php');

session_start();

// Créer un objet DateTime avec la date actuelle
$currentDate = new DateTime();

// Afficher la date actuelle dans le format 'Y-m-d H:i:s'
echo "<h2><br>Date_du_jour<br/><p></h2>";
echo $currentDate->format('Y-m-d');

echo "<h2><br>$_POST<br/><p></h2>";
var_dump($_POST);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $appointmentData = explode(' ', $_POST['appointment']);
    $appointmentDate = $appointmentData[0];
    $appointmentTime = $appointmentData[1];
    $userEmail = 'test@example.com';

    if (isset($_POST['weekStart'])) {
        $startDate = new DateTime($_POST['weekStart']);
    } else {
        $startDate = new DateTime($currentDate);
    }

    echo "<h2><br>StarDate_Debug<br/><p></h2>";
    var_dump($startDate);

    // Pour afficher la date dans le format 'Y-m-d' (année-mois-jour)
    echo "<h2><br>StarDate dans le format Y-m-d<br/><p></h2>";
    echo $startDate->format('Y-m-d'); // Affiche par exemple : 2023-06-19

    // Pour afficher la date dans le format 'd/m/Y' (jour/mois/année)
    echo "<h2><br>StarDate dans le format d/m/Y<br/><p></h2>";
    echo $startDate->format('d/m/Y'); // Affiche par exemple : 19/06/2023

    // Pour afficher la date et l'heure dans le format 'd-m-Y H:i:s' (jour-mois-année heure:minute:seconde)
    echo "<h2><br>StarDate dans le format d-m-Y H:i:s<br/><p></h2>";
    echo $startDate->format('d-m-Y H:i:s'); // Affiche par exemple : 19-06-2023 00:00:00

    $endDate = clone $startDate;
    $endDate->modify('+5 days');
    $interval = new DateInterval('P1D');
    $dateRange = new DatePeriod($startDate, $interval, $endDate);

    $stmt = $connexion->prepare("INSERT INTO agenda (date, heure_debut) VALUES (?, ?)");
    // $stmt = $connexion->prepare("INSERT INTO agenda (date, heure_debut, id_client) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $connexion->error);
    }

    // Code pour bloquer tout un créneau
    /*foreach ($dateRange as $date) {
        $appointmentDate = $date->format('Y-m-d');
        $stmt->bind_param("ss", $appointmentDate, $appointmentTime);

        if ($stmt->execute()) {
            echo "Appointment for " . $appointmentDate . " booked successfully!<br>";
        } else {
            echo "Error: " . $stmt->error . "<br>";
        }
    }*/

    // Code pour bloquer tout un seul créneau
    //$appointmentDate = $startDate->format('Y-m-d');
    $stmt->bind_param("ss", $appointmentDate, $appointmentTime);
    /* $id_client=1;
    $stmt->bind_param("ssi", $appointmentDate, $appointmentTime, $id_client);*/

    if ($stmt->execute()) {
        echo "Appointment for " . $appointmentDate . " booked successfully!<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }

    $stmt->close();
    $connexion->close();
}
