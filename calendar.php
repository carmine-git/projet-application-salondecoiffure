<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Calendar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
        }
        .day {
            text-align: center;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .day:hover {
            background-color: #f0f0f0;
        }
        .active {
            background-color: #007bff;
            color: #fff;
        }
        .navigation {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="navigation">
            <button onclick="prevMonth()">&#10094; Prev</button>
            <h2 id="monthYear"></h2>
            <button onclick="nextMonth()">Next &#10095;</button>
        </div>
        <div class="calendar" id="calendar">
            <?php
            // Get current year and month
            $currentYear = date('Y');
            $currentMonth = date('n');
            $daysInMonth = date('t');

            // Loop through days of the month
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $dayTimestamp = mktime(0, 0, 0, $currentMonth, $i, $currentYear);
                $dayOfWeek = date('N', $dayTimestamp);
                $dayOfWeek--;

                // Print empty cells for days before the first day of the month
                if ($i == 1) {
                    for ($j = 0; $j < $dayOfWeek; $j++) {
                        echo '<div class="day"></div>';
                    }
                }

                // Print day cell
                echo '<div class="day';
                if ($i == date('j') && $currentMonth == date('n') && $currentYear == date('Y')) {
                    echo ' active';
                }
                echo '">' . $i . '</div>';

                // Print new line after every 7 days (end of the week)
                if (($i + $dayOfWeek) % 7 == 0 || $i == $daysInMonth) {
                    echo '<br>';
                }
            }
            ?>
        </div>
        <p>Selected date: <span id="selectedDate"></span></p>
    </div>

    <script>
        var currentYear = <?php echo $currentYear; ?>;
        var currentMonth = <?php echo $currentMonth; ?>;

        function updateCalendar(year, month) {
            var calendar = document.getElementById('calendar');
            var monthYear = document.getElementById('monthYear');

            // Clear current calendar
            calendar.innerHTML = '';

            // Update month and year display
            monthYear.textContent = new Date(year, month - 1).toLocaleDateString('default', { month: 'long', year: 'numeric' });

            // Get number of days in the month
            var daysInMonth = new Date(year, month, 0).getDate();
            var firstDayOfWeek = new Date(year, month - 1, 1).getDay();

            // Loop through days of the month
            for (var i = 1; i <= daysInMonth; i++) {
                var dayOfWeek = (firstDayOfWeek + i - 1) % 7;

                // Print empty cells for days before the first day of the month
                if (i === 1) {
                    for (var j = 0; j < dayOfWeek; j++) {
                        calendar.innerHTML += '<div class="day"></div>';
                    }
                }

                // Print day cell
                var dayClass = (i === new Date().getDate() && month === new Date().getMonth() + 1 && year === new Date().getFullYear()) ? 'day active' : 'day';
                calendar.innerHTML += '<div class="' + dayClass + '" onclick="selectDate(' + i + ')">' + i + '</div>';

                // Print new line after every 7 days (end of the week)
                if ((i + dayOfWeek) % 7 === 0 || i === daysInMonth) {
                    calendar.innerHTML += '<br>';
                }
            }
        }

        function prevMonth() {
            currentMonth--;
            if (currentMonth < 1) {
                currentMonth = 12;
                currentYear--;
            }
            updateCalendar(currentYear, currentMonth);
        }

        function nextMonth() {
            currentMonth++;
            if (currentMonth > 12) {
                currentMonth = 1;
                currentYear++;
            }
            updateCalendar(currentYear, currentMonth);
        }

        function selectDate(day) {
            var selectedDate = day + ' ' + new Date(currentYear, currentMonth - 1).toLocaleDateString('default', { month: 'long' }) + ' ' + currentYear;
            document.getElementById('selectedDate').textContent = selectedDate;
        }

        // Initial update
        updateCalendar(currentYear, currentMonth);
    </script>
</body>
</html>
