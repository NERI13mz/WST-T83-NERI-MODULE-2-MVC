@extends('layouts.dashboardTemp')
@section('title', 'Grades')
@section('Pages')
    <span style="font-weight: 500;">Grades</span>
@endsection
@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6 class="gradient-title">Student Grades</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="gradesTable">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Subjects</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td>{{ $student->student_id }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                @foreach($student->subjects as $subject)
                                                    @php
                                                        $grade = $student->grades->where('subject_id', $subject->id)->first();
                                                    @endphp
                                                    <button class="btn btn-sm subject-btn {{ $subject->deleted_at ? 'bg-warning' : ($grade ? ($grade->remarks === 'Passed' ? 'bg-success' : 'bg-danger') : 'bg-secondary') }}"
                                                            onclick="manageGrades({{ $student->id }}, {{ $subject->id }}, '{{ $grade ? $grade->midterm : '' }}', '{{ $grade ? $grade->finals : '' }}')"
                                                            title="{{ $subject->name }} {{ $subject->deleted_at ? '(Deleted)' : '' }} - {{ $grade ? $grade->remarks : 'No Grade' }}">
                                                        <div class="d-flex flex-column align-items-center">
                                                            <span class="subject-code">{{ $subject->subject_code }}</span>
                                                            <span class="subject-name-small">{{ $subject->name }}</span>
                                                        </div>
                                                        @if($grade)
                                                            <button type="button" 
                                                                    class="delete-grade-btn"
                                                                    onclick="event.stopPropagation(); confirmDeleteGrade({{ $student->id }}, {{ $subject->id }})"
                                                                    title="Delete Grade">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        @endif
                                                    </button>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grade Modal -->
<div class="modal fade" id="gradeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Grades</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="gradeForm" action="{{ route('grades.store') }}" method="POST">
                @csrf
                <input type="hidden" name="student_id" id="grade_student_id">
                <input type="hidden" name="subject_id" id="grade_subject_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="midterm" class="form-label">Midterm Grade</label>
                        <input type="number" class="form-control" id="midterm" name="midterm" 
                               required min="1" max="5" step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="finals" class="form-label">Finals Grade</label>
                        <input type="number" class="form-control" id="finals" name="finals" 
                               required min="1" max="5" step="0.01">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            <button type="button" 
                                    class="btn bg-gradient-danger btn-icon" 
                                    id="deleteGradeBtn"
                                    onclick="confirmDeleteGrade(document.getElementById('grade_student_id').value, document.getElementById('grade_subject_id').value)" 
                                    title="Delete Grade"
                                    style="display: none;">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary btn-icon" data-bs-dismiss="modal" title="Close">
                                <i class="fas fa-times"></i>
                            </button>
                            <button type="submit" class="btn bg-gradient-primary btn-icon" title="Save Changes">
                                <i class="fas fa-save"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add DataTables CSS and JS -->
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>

<script>
function manageGrades(studentId, subjectId, midterm, finals) {
    document.getElementById('grade_student_id').value = studentId;
    document.getElementById('grade_subject_id').value = subjectId;
    document.getElementById('midterm').value = midterm;
    document.getElementById('finals').value = finals;
    
    // Show delete button only if there are grades
    const deleteBtn = document.getElementById('deleteGradeBtn');
    deleteBtn.style.display = (midterm || finals) ? 'inline-flex' : 'none';
    
    const gradeModal = new bootstrap.Modal(document.getElementById('gradeModal'));
    gradeModal.show();
}

document.getElementById('gradeForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const submitButton = this.querySelector('button[type="submit"]');
    submitButton.disabled = true;
    
    fetch(this.action, {
        method: 'POST',
        body: new FormData(this),
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                location.reload();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Input grade is not valid'
        });
    })
    .finally(() => {
        submitButton.disabled = false;
    });
});

function confirmDeleteGrade(studentId, subjectId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This will delete the grade permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/grades/delete/${studentId}/${subjectId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Grade has been deleted.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    throw new Error(data.message);
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'Error deleting grade'
                });
            });
        }
    });
}

$(document).ready(function() {
    const gradesTable = $('#gradesTable').DataTable({
        dom: '<"row"<"col-md-6"l><"col-md-6"f>>' +
             '<"row"<"col-12"tr>>' +
             '<"row"<"col-md-5"i><"col-md-7"p>>',
        pageLength: 10,
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        order: [[0, 'asc']],
        responsive: true,
        pagingType: "simple_numbers",
        language: {
            search: "",
            searchPlaceholder: "Search...",
            paginate: {
                first: '<i class="fas fa-angle-double-left"></i>',
                previous: '<i class="fas fa-angle-left"></i>',
                next: '<i class="fas fa-angle-right"></i>',
                last: '<i class="fas fa-angle-double-right"></i>'
            }
        }
    });

    // Custom search functionality
    $('#customSearch').on('keyup', function() {
        gradesTable.search(this.value).draw();
    });
});
</script>
@endpush

<style>
    /* Reset all button behaviors */
    .btn {
        all: unset;
        cursor: pointer !important;
        box-sizing: border-box !important;
    }

    /* Base subject button styles */
    .subject-btn {
        padding: 6px 12px !important;
        font-size: 12px !important;
        width: 120px !important;
        height: auto !important;
        min-height: 50px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 4px !important;
        border-radius: 8px !important;
        border: 2px solid var(--gold) !important;
        background: var(--navy-blue) !important;
        color: var(--gold) !important;
    }

    .subject-btn.bg-success {
        background: var(--gold) !important;
        color: var(--navy-blue) !important;
        border-color: var(--gold) !important;
    }

    .subject-btn.bg-danger {
        background: rgba(220, 38, 38, 0.1) !important;
        color: #dc2626 !important;
        border-color: #dc2626 !important;
    }

    .subject-btn.bg-warning {
        background: rgba(255, 215, 0, 0.1) !important;
        color: var(--gold) !important;
        border-color: var(--gold) !important;
    }

    /* Ensure text and content stability */
    .subject-btn, 
    .subject-btn * {
        transform: none !important;
        transition: none !important;
        animation: none !important;
        will-change: auto !important;
        backface-visibility: hidden !important;
        -webkit-font-smoothing: antialiased !important;
        text-rendering: optimizeLegibility !important;
    }

    /* Override any Bootstrap or framework styles */
    .btn,
    .btn-sm,
    .btn-icon,
    .subject-btn,
    .bg-success,
    .bg-danger,
    .bg-secondary {
        transform: none !important;
        transition: none !important;
        animation: none !important;
        box-shadow: none !important;
        will-change: auto !important;
    }

    /* Disable all hover, focus, and active states */
    .subject-btn:hover,
    .subject-btn:focus,
    .subject-btn:active {
        transform: none !important;
        transition: none !important;
        animation: none !important;
        box-shadow: none !important;
    }

    /* Small button variant */
    .btn-sm {
        padding: 8px 18px !important;
        font-size: 14px !important;
        min-width: 100px !important;
        height: 35px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        margin: 0.25rem !important;
    }

    /* Icon button styles */
    .btn-icon {
        width: 36px;
        height: 36px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--gold);
        background: var(--navy-blue) !important;
        border-radius: 10px;
        color: var(--gold);
    }

    .btn-icon:hover {
        background: var(--gold) !important;
        color: var(--navy-blue);
    }

    .btn-icon i {
        font-size: 14px !important;
        margin: 0 !important;
    }

    /* Warning/Edit button */
    .btn.bg-gradient-warning {
        background: linear-gradient(310deg, #4C1D95, #5B21B6) !important;
        color: white !important;
        border: none !important;
        box-shadow: none !important;
    }

    /* Danger/Delete button */
    .btn.bg-gradient-danger {
        background: linear-gradient(310deg, #dc2626, #ef4444) !important;
        color: white !important;
        border: none !important;
        box-shadow: none !important;
    }

    /* Primary button (for modal) */
    .btn.bg-gradient-primary {
        background: linear-gradient(310deg, #4C1D95, #5B21B6) !important;
        color: white !important;
        border: none !important;
        box-shadow: none !important;
    }

    .btn.bg-gradient-primary:hover {
        background: linear-gradient(310deg, #5B21B6, #4C1D95) !important;
        box-shadow: none !important;
        transform: none !important;
    }

    /* Secondary button (for modal close) */
    .btn.btn-secondary {
        background: #6B7280 !important;
        color: white !important;
        border: none !important;
        box-shadow: none !important;
    }

    .btn.btn-secondary:hover {
        background: #4B5563 !important;
        box-shadow: none !important;
        transform: none !important;
    }

    /* Icon styles */
    .btn i {
        font-size: 0.875rem !important;
        line-height: 1 !important;
        width: auto !important;
        height: auto !important;
        transform: none !important;
    }

    /* Button spacing */
    td .btn + .btn,
    td .btn + form,
    td form + .btn {
        margin-left: 0.5rem !important;
    }

    /* Disable all hover effects */
    .btn:hover,
    .btn:focus,
    .btn:active {
        transform: none !important;
        box-shadow: none !important;
    }

    /* Card header styling */
    .card-header {
        background: var(--navy-blue) !important;
        padding: 1.25rem !important;
        border-radius: 15px 15px 0 0;
    }

    .card-header h6 {
        color: var(--white) !important;
        font-weight: 500;
        font-size: 1.1rem;
    }

    /* Add spacing between action buttons */
    td .btn + form,
    td form + .btn {
        margin-left: 0.5rem;
    }

    /* Add this style to override SweetAlert2 default styles */
    .swal2-confirm {
        background: var(--navy-blue) !important;
        border: 2px solid var(--gold) !important;
        color: var(--gold) !important;
    }

    .swal2-confirm:hover {
        background: var(--gold) !important;
        color: var(--navy-blue) !important;
    }

    /* DataTables Custom Styling */
    .dataTables_wrapper {
        padding: 1.5rem;
    }

    /* Length Control - Single Implementation */
    #gradesTable_length {
        margin-bottom: 15px;
    }

    #gradesTable_length label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin: 0;
        font-size: 0.875rem;
        white-space: nowrap;
        color: var(--navy-blue);
        font-weight: 500;
    }

    #gradesTable_length select {
        width: 80px;
        height: 36px;
        padding: 0.375rem 1.75rem 0.375rem 0.75rem;
        margin: 0 0.5rem;
        font-size: 0.875rem;
        border: 1px solid var(--gold);
        border-radius: 6px;
        background-color: transparent;
        color: var(--navy-blue);
        cursor: pointer;
        appearance: auto;
    }

    .dataTables_wrapper .row:first-child {
        align-items: center;
        margin-bottom: 1rem;
    }

    .dataTables_wrapper .col-md-6:first-child {
        display: flex;
        align-items: center;
    }

    .dataTables_info {
        font-size: 0.875rem;
        padding-top: 0.5rem;
    }

    .dataTables_paginate {
        margin-top: 1rem;
        text-align: right;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 5px;
    }

    .paginate_button {
        min-width: 36px;
        height: 36px;
        padding: 0.375rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--gold);
        border-radius: 6px;
        background-color: transparent;
        color: var(--navy-blue);
        margin: 0 2px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .paginate_button.current {
        background: var(--navy-blue) !important;
        color: var(--gold) !important;
        border-color: var(--navy-blue) !important;
    }

    .paginate_button:hover:not(.current):not(.disabled) {
        background: var(--gold) !important;
        color: var(--navy-blue) !important;
    }

    .paginate_button.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        color: #999;
    }

    /* Modal styling */
    .modal-content {
        border: none;
        border-radius: 1rem;
        overflow: hidden;
    }

    .modal-header {
        background: var(--navy-blue);
        border-bottom: 2px solid var(--gold);
        padding: 1.5rem;
    }

    .modal-title {
        color: var(--white);
        font-weight: 500;
    }

    .modal-header .btn-close {
        background-color: white;
        opacity: 0.8;
    }

    .modal-footer {
        border-top: 1px solid rgba(0, 0, 0, 0.1);
        padding: 1rem;
    }

    .modal-footer .btn {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
    }

    /* Form styling */
    .form-label {
        color: var(--navy-blue);
        font-weight: 500;
    }

    .form-control {
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.5rem;
        padding: 0.75rem;
    }

    .form-control:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.1);
    }

    /* Modal footer button styles */
    .modal-footer .btn-icon {
        width: 38px !important;
        height: 38px !important;
    }

    .modal-footer .btn-icon i {
        font-size: 16px !important;
    }

    /* Secondary button style */
    .btn.btn-secondary.btn-icon {
        background: #6B7280 !important;
        color: white !important;
    }

    .btn.btn-secondary.btn-icon:hover {
        background: #4B5563 !important;
    }

    .subject-grade-card {
        border: 1px solid #e9ecef;
        border-radius: 8px;
        padding: 12px;
        margin: 4px;
        background-color: #f8f9fa;
        min-width: 250px;
    }

    .subject-name {
        font-weight: 600;
        margin-bottom: 8px;
        color: #344767;
    }

    .grades {
        display: flex;
        flex-direction: column;
        gap: 4px;
        margin-bottom: 8px;
    }

    .grades span {
        font-size: 0.875rem;
    }

    .actions {
        display: flex;
        gap: 8px;
        margin-top: 8px;
    }

    .gap-2 {
        gap: 0.5rem !important;
    }

    .d-flex {
        display: flex !important;
    }

    .flex-wrap {
        flex-wrap: wrap !important;
    }

    .subject-code {
        font-weight: bold !important;
        font-size: 12px !important;
        margin-bottom: 2px !important;
    }

    .subject-name-small {
        font-size: 10px !important;
        text-align: center !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
        max-width: 100% !important;
    }

    .subject-btn {
        position: relative !important;
    }

    .delete-grade-btn {
        position: absolute !important;
        top: -8px !important;
        right: -8px !important;
        width: 20px !important;
        height: 20px !important;
        border-radius: 50% !important;
        background: #dc2626 !important;
        border: none !important;
        color: white !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 10px !important;
        padding: 0 !important;
        cursor: pointer !important;
        opacity: 0 !important;
        transition: opacity 0.2s !important;
    }

    .subject-btn:hover .delete-grade-btn {
        opacity: 1 !important;
    }

    /* Search Control */
    .dataTables_filter,
    #gradesTable_filter {
        margin-left: auto;
    }

    .dataTables_filter label,
    #gradesTable_filter label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin: 0;
        color: var(--navy-blue);
        font-weight: 500;
    }

    .dataTables_filter input,
    #gradesTable_filter input {
        width: 220px;
        height: 36px;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        border: 1px solid var(--gold);
        border-radius: 6px;
        background-color: transparent;
        color: var(--navy-blue);
    }

    /* Gold Gradient Text Effect */
    .gradient-title {
        background: linear-gradient(45deg, var(--gold), #FFA500, var(--gold-dark));
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 600;
        font-size: 1.25rem;
        margin-bottom: 0;
        text-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .gradient-title:hover {
        background: linear-gradient(45deg, var(--gold-dark), #FFA500, var(--gold));
        -webkit-background-clip: text;
        background-clip: text;
    }
</style>

@endsection