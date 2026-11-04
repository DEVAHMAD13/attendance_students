async function loadDashboard() {
    try {
        const res = await fetch('/api/dashboard', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });
        if (!res.ok) throw new Error('HTTP ' + res.status);
        const data = await res.json();
        document.getElementById('total-students').textContent = data.total_students ?? 0;
        document.getElementById('today-attendances').textContent = data.today_attendances ?? 0;
    } catch (e) {
        console.error('Dashboard error:', e);
    }
}

async function loadAttendance() {
    const date = document.getElementById('filter-date').value;
    const url = date ? `/api/attendance?date=${date}` : '/api/attendance';
    const body = document.getElementById('attendance-body');

    try {
        const res = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });
        if (!res.ok) throw new Error('HTTP ' + res.status);

        const json = await res.json();
        const rows = Array.isArray(json) ? json : (json.data ?? []);

        if (!rows.length) {
            body.innerHTML = `<tr><td colspan="5">No records found</td></tr>`;
            return;
        }

        body.innerHTML = rows.map(r => `
            <tr>
                <td>${r.students.full_name ?? '-'}</td>
                <td>${r.students.student_code ?? '-'}</td>
                <td>${r.attendance_date ?? '-'}</td>
                <td>${r.attendance_time ?? r.created_at?.substring(11, 19) ?? '-'}</td>
                <td>${r.status ?? '-'}</td>
            </tr>`
        ).join('');
    } catch (e) {
        body.innerHTML = `<tr><td colspan="5">Loading error: ${e.message}</td></tr>`;
    }
}

loadDashboard();
loadAttendance();