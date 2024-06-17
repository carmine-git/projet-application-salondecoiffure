<?php
require_once "mysqli.php";

if (isset($_POST['weekStart'])) {
    $startDate = new DateTime($_POST['weekStart']);
} else {
    $startDate = new DateTime('2024-06-10');
}
$endDate = clone $startDate;
$endDate->modify('+5 days');
$interval = new DateInterval('P1D');
$dateRange = new DatePeriod($startDate, $interval, $endDate->add($interval));

function isSlotBusy($date, $time, $connexion)
{
    $stmt = $connexion->prepare("SELECT * FROM agenda WHERE date = ? AND heure_debut = ?");
    $stmt->bind_param("ss", $date, $time);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .calendar-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1200px;
        }

        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .calendar-header button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .calendar-header span {
            font-size: 1.2em;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background: #007bff;
            color: white;
        }

        button.slot {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }

        button.slot.busy {
            background: #dc3545;
            color: white;
        }

        button.slot.available {
            background: #28a745;
            color: white;
        }

        @media (max-width: 768px) {
            .calendar-header {
                flex-direction: column;
            }

            .calendar-header button {
                margin: 5px 0;
            }
        }
    </style>
</head>

<body>
    <div class="calendar-container">
        <div class="calendar-header">
            <button onclick="navigateWeek(-1)">Semaine précédente</button>
            <span><?php echo $startDate->format('d/m/Y') . ' - ' . $endDate->format('d/m/Y'); ?></span>
            <button onclick="navigateWeek(1)">Semaine suivante</button>
        </div>
        <form method="POST" action="book_appointment.php">
            <input type="hidden" id="weekStart" name="weekStart" value="<?php echo $startDate->format('Y-m-d'); ?>">
            <table>
                <tr>
                    <?php foreach ($dateRange as $date) : ?>
                        <th><?php echo $date->format('l d F Y'); ?></th>
                    <?php endforeach; ?>
                </tr>
                <tr>
                    <?php foreach ($dateRange as $date) : ?>
                        <td>
                            <?php for ($hour = 9; $hour <= 17; $hour++) : ?>
                                <?php $time = sprintf("%02d:00:00", $hour); ?>
                                <div>
                                    <?php if (isSlotBusy($date->format('Y-m-d'), $time, $connexion)) : ?>
                                        <button type="button" class="slot busy" disabled>Occupé</button>
                                    <?php else : ?>
                                        <button type="submit" name="appointment" value="<?php echo $date->format('Y-m-d') . ' ' . $time; ?>" class="slot available"><?php echo $hour . ':00'; ?></button>
                                    <?php endif; ?>
                                </div>
                            <?php endfor; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            </table>
        </form>
    </div>
    <script>
        function navigateWeek(offset) {
            const currentWeekStart = new Date(document.getElementById('weekStart').value);
            currentWeekStart.setDate(currentWeekStart.getDate() + offset * 7);
            document.getElementById('weekStart').value = currentWeekStart.toISOString().split('T')[0];
            document.forms[0].submit();
        }
    </script>
</body>

</html>
