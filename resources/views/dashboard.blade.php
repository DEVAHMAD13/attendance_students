@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <main>
        <h2>Dashboard</h2>

        <div class="cards">
            <div class="card">
                <h3>Total Students</h3>
                <div class="value" id="total-students">—</div>
            </div>
            <div class="card">
                <h3>Today's Attendance</h3>
                <div class="value" id="today-attendances">—</div>
            </div>
        </div>

        <h3>Attendance Records</h3>
        <div class="form-row">
            <input type="date" id="filter-date">
            <button onclick="loadAttendance()">Filter</button>
            <button onclick="document.getElementById('filter-date').value='';loadAttendance()">All</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Student Code</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="attendance-body">
                <tr>
                    <td colspan="5">Loading...</td>
                </tr>
            </tbody>
        </table>
    </main>
    <script src="{{ asset('js/dashboard.js') }}"></script>
@endsection