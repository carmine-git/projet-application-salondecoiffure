
<?php
session_start();

require_once('mysqli.php');


$currentDate = new DateTime();
$currentDate = $currentDate->format('Y-m-d');

$client_id = $_SESSION['client_id'];
$id_employé = 2;

echo "<h2><br>Date_du_jour</br><p></h2>";
echo $currentDate;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['appointment'])) {
    var_dump($_POST);
    $appointmentData = explode(' ', $_POST['appointment']);
    $appointmentDate = $appointmentData[0];
    $appointmentTime = $appointmentData[1];
    $appointmentDateTime = new DateTime($appointmentDate . ' ' . $appointmentTime);
    $appointmentDateTimeFin = clone $appointmentDateTime;
    $appointmentDateTimeFin->modify('+1 hour');

    $appointmentTimeFin = $appointmentDateTimeFin->format('H:i:s');

    $userEmail = 'test@example.com';

    if (isset($_POST['weekStart'])) {
        $startDate = new DateTime($_POST['weekStart']);
    } else {
        $startDate = new DateTime($currentDate);
    }

    echo "<p style='color: red;'>SESSION ID</p>";
    var_dump(session_id());

    echo "<h2><br>StarDate_Debug</br><p></h2>";
    var_dump($startDate);

    echo "<h2><br>Votre date et l'heure de votre RDV</br><p></h2>";
    echo "Votre RDV en date du : " . $appointmentDate . " est prévu de " . $appointmentTime . " à " . $appointmentTimeFin . " est en cours de traitement!<br>";

    echo "<h2><br>StarDate dans le format Y-m-d</br><p></h2>";

    echo "<h2><br>StarDate dans le format d/m/Y</br><p></h2>";

    echo "<h2><br>StarDate dans le format d-m-Y H:i:s</br><p></h2>";
    echo "" . $startDate->format('d-m-Y H:i:s') . "</br>"; // Affiche par exemple : 19-06-2023 00:00:00

    // A quoi serviront ces variables ?
    $endDate = clone $startDate;
    $endDate->modify('+5 days');
    $interval = new DateInterval('P1D');
    $dateRange = new DatePeriod($startDate, $interval, $endDate);



    // Version 1 : 2 champs insérés
    // Code pour bloquer tout un seul créneau
    /* $stmt = $connexion->prepare("INSERT INTO agenda (date, heure_debut) VALUES (?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $connexion->error);
    }
    $stmt->bind_param("ss", $appointmentDate, $appointmentTime);

    if ($stmt->execute()) {
        echo "Appointment for " . $appointmentDate . " booked successfully!<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }*/

    // Version 2 : 3 champs insérés
    // Code pour bloquer tout un seul créneau
    /* $stmt = $connexion->prepare("INSERT INTO agenda (date, heure_debut, date_de_creation) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $connexion->error);
    }

    $stmt->bind_param("sss", $appointmentDate, $appointmentTime, $currentDate);

    if ($stmt->execute()) {
        echo "Appointment for " . $appointmentDate . " booked successfully!<br>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
    }*/

    // Version 3 : 6 champs insérés
    // Code pour bloquer tout un seul créneau

    try {
        $query = "INSERT INTO agenda (date, heure_debut, heure_fin, date_de_creation, client_id, id_employé) VALUES (?, ?, ?, ?, ? ,?)";
        $st = $connexion->prepare($query);
        $st->bind_param("sssssi", $appointmentDate, $appointmentTime, $appointmentTimeFin, $currentDate, $client_id, $id_employé);
        $st->execute();
        echo "Appointment for " . $appointmentDate . " booked successfully!<br>";
        $st->close();
        $connexion->close();
    } catch (Error $e) {
        echo "Prepare failed: " . $connexion->error;
    }

    // Code pour bloquer tout un créneau
    // foreach ($dateRange as $date) {
    //     $appointmentDate = $date->format('Y-m-d');
    //     $stmt->bind_param("ss", $appointmentDate, $appointmentTime);

    //     if ($stmt->execute()) {
    //         echo "Appointment for " . $appointmentDate . " booked successfully!<br>";
    //     } else {
    //         echo "Error: " . $stmt->error . "<br>";
    //     }
    // }


}
