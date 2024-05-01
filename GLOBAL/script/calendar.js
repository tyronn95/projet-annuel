


document.addEventListener('DOMContentLoaded', () => {
    const monthNames = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
    const calendarBody = document.getElementById('calendar-body');
    const monthAndYear = document.getElementById('month-and-year');
    let currentMonth = new Date();

    function setupEventListeners() {
        document.getElementById('next').addEventListener('click', () => {
            currentMonth.setMonth(currentMonth.getMonth() + 1);
            generateCalendar(currentMonth);
        });

        document.getElementById('previous').addEventListener('click', () => {
            currentMonth.setMonth(currentMonth.getMonth() - 1);
            generateCalendar(currentMonth);
        });

        document.getElementById('today').addEventListener('click', () => {
            currentMonth = new Date();
            generateCalendar(currentMonth);
        });

        document.getElementById('reservationForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            addReservation(startDate, endDate);
        });
    }

    function addReservation(start, end) {
        fetch('http://localhost:5000/reservations', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ start, end }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Erreur réseau ou côté serveur');
            }
            return response.json();
        })
        .then(data => {
            alert('Réservation ajoutée avec succès.');
            generateCalendar(currentMonth);
        })
        .catch(error => console.error('Erreur:', error));
    }

    function generateCalendar(d) {
        const firstDay = new Date(d.getFullYear(), d.getMonth(), 1);
        const lastDay = new Date(d.getFullYear(), d.getMonth() + 1, 0);
        monthAndYear.innerHTML = `${monthNames[d.getMonth()]} ${d.getFullYear()}`;
        calendarBody.innerHTML = '';
        let date = 1;

        let row = document.createElement('tr');
        for (let i = 0; i < firstDay.getDay(); i++) {
            let cell = document.createElement('td');
            cell.classList.add('empty');
            row.appendChild(cell);
        }

        while (date <= lastDay.getDate()) {
            if (row.children.length === 7) {
                calendarBody.appendChild(row);
                row = document.createElement('tr');
            }
            let cell = document.createElement('td');
            cell.innerText = date;
            let fullDate = `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
            cell.setAttribute('data-date', fullDate);
            if (date === new Date().getDate() && d.getMonth() === new Date().getMonth()) {
                cell.classList.add('current-day'); // Highlight the current day
            }
            row.appendChild(cell);
            date++;
        }

        while (row.children.length < 7) {
            let cell = document.createElement('td');
            cell.classList.add('empty');
            row.appendChild(cell);
        }

        calendarBody.appendChild(row);
        fetchReservations();
    }

    function fetchReservations() {
        fetch('http://localhost:5000/reservations')
        .then(response => response.json())
        .then(reservations => {
            highlightReservedDates(reservations);
        })
        .catch(error => console.error('Erreur lors de la récupération des réservations:', error));
    }

    function highlightReservedDates(reservations) {
        reservations.forEach(reservation => {
            const startDate = new Date(reservation.start);
            const endDate = new Date(reservation.end);

            for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
                let dateString = d.toISOString().split('T')[0]; // Format YYYY-MM-DD
                let cell = document.querySelector(`td[data-date="${dateString}"]`);
                if (cell) {
                    cell.classList.add('reserved');
                }
            }
        });
    }

    setupEventListeners();
    generateCalendar(currentMonth);
});



