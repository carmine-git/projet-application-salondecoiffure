const appointments = [
  { date: "2024/05/27", time: "09:00", available: true },
  { date: "2024/05/30", time: "10:00", available: false },
];

let currentWeekStart = new Date();

function startOfWeek(date) {
  const d = new Date(date);
  const day = d.getDay();
  const diff = d.getDate() - day + (day == 0 ? -6 : 1);
  return new Date(d.setDate(diff));
}

function getWeekRange(date) {
  const start = startOfWeek(date);
  const end = new Date(start);
  end.setDate(start.getDate() + 6);
  return { start, end };
}

function formatDate(date) {
  const options = { year: "numeric", month: "2-digit", day: "2-digit" };
  return date.toLocaleDateString("fr", options);
}

function renderWeek() {
  const { start, end } = getWeekRange(currentWeekStart);
  document.getElementById("weekRange").innerText = `${formatDate(
    start
  )} - ${formatDate(end)}`;

  const weekDays = document.getElementById("weekDays");
  weekDays.innerHTML = "";
  for (let i = 0; i < 7; i++) {
    const day = new Date(start);
    day.setDate(start.getDate() + i);
    weekDays.innerHTML += `<div>${day.toDateString()}</div>`;
  }

  const timeSlots = document.getElementById("timeSlots");
  timeSlots.innerHTML = "";
  for (let i = 0; i < 7; i++) {
    const day = new Date(start);
    day.setDate(start.getDate() + i);
    const dayStr = formatDate(day);
    const dayAppointments = appointments.filter((app) => app.date === dayStr);

    let dayHtml = `<div>`;
    for (let hour = 9; hour <= 17; hour++) {
      const time = `${hour}:00`;
      const appointment = dayAppointments.find((app) => app.time === time);
      const available = appointment ? appointment.available : true;
      dayHtml += `<div class="time-slot ${
        available ? "available" : "taken"
      }">${time}</div>`;
    }
    dayHtml += `</div>`;
    timeSlots.innerHTML += dayHtml;
  }
}

document.getElementById("prevWeek").addEventListener("click", () => {
  currentWeekStart.setDate(currentWeekStart.getDate() - 7);
  renderWeek();
});

document.getElementById("nextWeek").addEventListener("click", () => {
  currentWeekStart.setDate(currentWeekStart.getDate() + 7);
  renderWeek();
});

renderWeek();
