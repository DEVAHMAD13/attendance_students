@extends('layouts.app')
@section('title', 'Add Student')

@section('content')
    <main>
        <div class="page-head">
            <h2>Add New Student</h2>
            <a href="{{ route('students.index') }}" class="btn btn-light">← Back to List</a>
        </div>

        <div id="alert-container"></div>

        <div class="form-card">
            
            <div class="form-group">
                <label for="full_name">Student Name <span class="req">*</span></label>
                <input type="text" id="full_name" name="full_name"
                    placeholder="e.g. John Doe" maxlength="255" required>
                <div class="error-text" id="error-full_name"></div>
            </div>

            <div class="form-group">
                <label for="student_code">Student Code <span class="req">*</span></label>
                <input type="text" id="student_code" name="student_code"
                    placeholder="e.g. S001" maxlength="50" required>
                <div class="error-text" id="error-student_code"></div>
            </div>

            <div class="form-group">
                <label for="card_uid">RFID Card UID <span class="req">*</span></label>
                <input type="text" id="card_uid" name="card_uid"
                    placeholder="e.g. A1B2C3D4" maxlength="50" required style="text-transform: uppercase;">
                <small class="hint">Scan the card on the reader to view the UID value on the OLED screen or Serial Monitor, then paste it here.</small>
                <div class="error-text" id="error-card_uid"></div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-primary" onclick="addStudent()">Save Student</button>
                <a href="{{ route('students.index') }}" class="btn btn-light">Cancel</a>
            </div>
        </div>
    </main>
    <script src="{{ asset('js/student.js') }}"></script>
@endsection