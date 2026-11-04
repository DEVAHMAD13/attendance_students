async function loadStudents() {
    const code = document.getElementById('code').value;
    const name = document.getElementById('name').value;
    const uid = document.getElementById('uid').value;

    const params = new URLSearchParams();
    if (code) params.append('code', code);
    if (name) params.append('name', name);
    if (uid) params.append('uid', uid);

    const url = `/api/students?${params.toString()}`;
    const tbody = document.getElementById('students-body');

    try {
        tbody.innerHTML = '<tr><td colspan="4">Searching...</td></tr>';

        const res = await fetch(url, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });

        if (!res.ok) throw new Error('HTTP ' + res.status);

        const students = await res.json();

        if (!students.length) {
            tbody.innerHTML = '<tr><td colspan="4">No matching results found</td></tr>';
            return;
        }

        tbody.innerHTML = students.map(s => `
            <tr>
                <td>${s.full_name ?? '-'}</td>
                <td>${s.student_code ?? '-'}</td>
                <td>${s.card_uid ?? '-'}</td>
                <td>
                    <a href="/students/${s.id}/edit">Edit</a>
                </td>
            </tr>
        `).join('');

    } catch (e) {
        console.error('Search error:', e);
        tbody.innerHTML = `<tr><td colspan="4">Error fetching data: ${e.message}</td></tr>`;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    loadStudents();
});

async function addStudent() {
    const payload = {
        student_code: document.getElementById('full_name').value.trim(),
        full_name: document.getElementById('student_code').value.trim(),
        card_uid: document.getElementById('card_uid').value.trim().toUpperCase(),
    };
    const res = await fetch('/api/students/store', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify(payload),
    });
    const data = await res.json();
    if (!res.ok) {
        document.getElementById('msg').textContent = data.message || 'Input error';
        return;
    }
    document.getElementById('msg').textContent = '';
    ['code', 'name', 'uid'].forEach(id => document.getElementById(id).value = '');
}

async function editStudent(id, oldName, oldUid) {
    const res = await fetch("/students/id/edit", {
        method: 'GET',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
    });
    if (res.ok) loadStudents();
    else alert('Unable to edit');
}

async function updateStudent() {
    const studentId = document.getElementById('student_id').value;
    const full_name = document.getElementById('full_name').value;
    const student_code = document.getElementById('student_code').value;
    const card_uid = document.getElementById('card_uid').value;

    document.getElementById('alert-container').innerHTML = '';
    document.querySelectorAll('.error-text').forEach(el => el.textContent = '');

    try {
        const response = await fetch(`/api/students/${studentId}/update`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                full_name: full_name,
                student_code: student_code,
                card_uid: card_uid
            })
        });

        const result = await response.json();

        if (!response.ok) {
            if (response.status === 422 && result.errors) {
                for (const [key, messages] of Object.entries(result.errors)) {
                    const errorDiv = document.getElementById(`error-${key}`);
                    if (errorDiv) {
                        errorDiv.textContent = messages[0];
                    }
                }
            } else {
                alert('An error occurred while updating.');
            }
            return;
        }

        document.getElementById('alert-container').innerHTML = `
            <div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 10px; margin-bottom: 15px; border-radius: 4px;">
                Data updated successfully!
            </div>
        `;

    } catch (error) {
        console.error('Error:', error);
        alert('Unable to connect to the server.');
    }
}

loadStudents();