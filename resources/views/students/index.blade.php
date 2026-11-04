@extends('layouts.app')
@section('title', 'Students')

@section('content')
    <main>
        <h2>Student Management</h2>

        <div class="form-row">
            <input id="code" placeholder="Student Code" oninput="loadStudents()">
            <input id="name" placeholder="Full Name" oninput="loadStudents()">
            <input id="uid" placeholder="Card UID (e.g. A1B2C3D4)" oninput="loadStudents()">
            <a href="{{ route('students.create') }}">
                <div class="createStudent"> Add Student </div>
            </a>
        </div>
        <p id="msg" style="color:#b91c1c"></p>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Card UID</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="students-body"></tbody>
        </table>
    </main>
    <script src="{{ asset('js/student.js') }}"></script>
@endsection