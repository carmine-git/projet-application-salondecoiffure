<?php
require_once "mysqli.php";

var_dump($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $appointmentData = explode(' ', $_POST['appointment']);
    $appointmentDate = $appointmentData[0];
    $appointmentTime = $appointmentData[1];
    $userEmail = 'test@example.com';

    if (isset($_POST['weekStart'])) {
        $startDate = new DateTime($_POST['weekStart']);
    } else {
        $startDate = new DateTime('2024-06-10');
    }
    var_dump($startDate);
    /*echo $startDate->date;*/
    
    /*$endDate = clone $startDate;
    $endDate->modify('+5 days');
    $interval = new DateInterval('P1D');
    $dateRange = new DatePeriod($startDate, $interval, $endDate->add($interval));

    $stmt = $connexion->prepare("INSERT INTO agenda (date, heure_debut) VALUES (?, ?)");
    $stmt->bind_param("ss", $appointmentDate, $appointmentTime);

    $result = $stmt->get_result();
    return $result->num_rows > 0;
    // var_dump($result->num_rows);

    if ($stmt->execute()) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }*/
}
