<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier Hebdomadaire</title>
    <link rel="stylesheet" href="calendar.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f2f5;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #0056b3;
        }

        .calendar-container {
            max-width: 900px;
            width: 100%;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .navigation {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            background: #0056b3;
            color: #fff;
        }

        .navigation a {
            color: #fff;
            text-decoration: none;
            font-weight: 500;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: center;
            padding: 10px;
        }

        th {
            background-color: #f8f9fa;
            color: #0056b3;
            font-weight: 500;
        }

        td {
            border: 1px solid #e9ecef;
        }

        .booked {
            background-color: #f8d7da;
            color: #721c24;
        }

        .available a {
            display: inline-block;
            padding: 8px 12px;
            background-color: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .available a:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <h1>Calendrier Hebdomadaire</h1>
    <div class="calendar-container">
        <?php
        session_start();
        require_once('mysqli.php');

        if ($connexion->connect_error) {
            die("Connection failed: " . $connexion->connect_error);
        }

        setlocale(LC_TIME, 'fr_FR.UTF-8');
        date_default_timezone_set('Europe/Paris');

        function getBookings($conn)
        {
            $bookings = [];
            $sql = "SELECT date_rdv, heure_rdv, client_id FROM agenda WHERE etat = 'confirmé'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $date = str_replace('-', '', $row['date_rdv']);
                    $time = substr($row['heure_rdv'], 0, 5);
                    $slotId = $date . '_' . $time;
                    $bookings[$slotId] = 'Réservé';
                }
            }

            return $bookings;
        }

        function displayWeek($year, $week, $bookings)
        {
            $dto = new DateTime();
            $dto->setISODate($year, $week);
            $weekStart = clone $dto;
            $weekStart->modify('Monday this week');
            $weekEnd = clone $weekStart;
            $weekEnd->modify('+5 days');

            echo "<table>";
            echo "<tr><th>Heure</th>";

            for ($i = 0; $i < 6; $i++) {
                echo "<th>" . strftime('%A %d %B', $weekStart->getTimestamp()) . "</th>";
                $weekStart->modify('+1 day');
            }
            echo "</tr>";

            for ($hour = 9; $hour <= 17; $hour++) {
                for ($minute = 0; $minute < 60; $minute += 30) {
                    echo "<tr>";
                    $time = sprintf("%02d:%02d", $hour, $minute);
                    echo "<td>$time</td>";

                    $weekStart = clone $dto;
                    $weekStart->modify('Monday this week');

                    for ($i = 0; $i < 6; $i++) {
                        $date = $weekStart->format('Ymd');
                        $slotId = $date . "_$time";
                        echo "<td id='slot_$slotId' class='";
                        if (isset($bookings[$slotId])) {
                            echo "booked'>" . $bookings[$slotId];
                        } else {
                            $dateFormatted = $weekStart->format('Y-m-d');
                            echo "available'><a href='sexe.php?date=$dateFormatted&time=$time'>Réserver</a>";
                        }
                        echo "</td>";
                        $weekStart->modify('+1 day');
                    }
                    echo "</tr>";
                }
            }

            echo "</table>";
        }

        function displayNavigation($year, $week)
        {
            $prevWeek = $week - 1;
            $nextWeek = $week + 1;
            $prevYear = $year;
            $nextYear = $year;

            if ($prevWeek < 1) {
                $prevWeek = 52;
                $prevYear -= 1;
            }

            if ($nextWeek > 52) {
                $nextWeek = 1;
                $nextYear += 1;
            }

            echo "<div class='navigation'>";
            echo "<a href='?year=$prevYear&week=$prevWeek'>Semaine précédente</a>";
            echo "<a href='?year=$nextYear&week=$nextWeek'>Semaine suivante</a>";
            echo "</div>";
        }

        $year = isset($_GET['year']) ? $_GET['year'] : 2024;
        $week = isset($_GET['week']) ? $_GET['week'] : 26;

        $bookings = getBookings($connexion);

        displayNavigation($year, $week);
        displayWeek($year, $week, $bookings);

        $connexion->close();
        ?>
    </div>
</body>

</html>