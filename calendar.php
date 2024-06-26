<?php
// Inclure le fichier d'initialisation de la connexion à la base de données
require_once('mysqli.php');

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
    <link rel="stylesheet" href="calendar.css">
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
                                        <a href="sexe.html">
                                            <button type="submit" name="appointment" value="<?php echo $date->format('Y-m-d') . ' ' . $time; ?>" class="slot available">
                                                <?php echo $hour . ':00'; ?>
                                            </button>
                                        </a>
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