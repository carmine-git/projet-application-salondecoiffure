<?php
$host = 'localhost';
$db = 'test3';
$user = 'root';
$pass = 'YZ@pqqKfgCUTl&vVh@d&0#4W';

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['appointment'])) {
    $appointmentData = explode(' ', $_POST['appointment']);
    $appointmentDate = $appointmentData[0];
    $appointmentTime = $appointmentData[1];
    $userEmail = 'test@example.com';

    // Get the start date for the current week from the POST data or default to the initial week
    if (isset($_POST['weekStart'])) {
        $startDate = new DateTime($_POST['weekStart']);
    } else {
        $startDate = new DateTime('2024-06-10');
    }
    $endDate = clone $startDate;
    $endDate->modify('+5 days');
    $interval = new DateInterval('P1D');
    $dateRange = new DatePeriod($startDate, $interval, $endDate->add($interval));

    $stmt = $conn->prepare("INSERT INTO agenda (date, heure_debut) VALUES (?, ?)");
    $stmt->bind_param("ss", $appointmentDate, $appointmentTime);

    if ($stmt->execute()) {
        echo "Appointment booked successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
