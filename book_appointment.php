
<?php
session_start();

require_once('mysqli.php');

$currentDate = new DateTime();
$currentDate = $currentDate->format('Y-m-d');

$client_id = $_SESSION['client_id'];
$id_employé = 2;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['appointment'])) {
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

    try {
        $query = "INSERT INTO agenda (date, heure_debut, heure_fin, date_de_creation, client_id, id_employé) VALUES (?, ?, ?, ?, ? ,?)";
        $st = $connexion->prepare($query);
        $st->bind_param("sssssi", $appointmentDate, $appointmentTime, $appointmentTimeFin, $currentDate, $client_id, $id_employé);
        $st->execute();
        $st->close();
        $connexion->close();
    } catch (Error $e) {
        echo "Prepare failed: " . $connexion->error;
    }

    header("location: sexe.html");
}
