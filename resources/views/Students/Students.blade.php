@extends('layouts.dashboardTemp')
@section('title', 'Students')
@section('Pages')
    <span style="font-weight: 500;">Students</span>
@endsection
@section('content')
<!-- DataTables Resources -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-4 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0 gradient-title">Student Lists</h6>
                        </div>
                        <button type="button" class="btn bg-gradient-primary btn-icon" 
                                data-bs-toggle="modal" 
                                data-bs-target="#addStudentModal" 
                                title="Add New Student">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive">
                            <table id="studentsTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                    <tr>
                                        <td>{{ $student->student_id }}</td>
                                        <td>{{ $student->name }}</td>
                                        <td>{{ $student->email }}</td>
                                        <td>
                                            <span class="badge {{ $student->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                                {{ $student->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn bg-gradient-warning btn-icon" 
                                                    onclick="editStudent('{{ $student->id }}', '{{ $student->student_id }}', '{{ $student->name }}', '{{ $student->email }}', '{{ $student->status }}')"
                                                    title="Edit Student">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            
                                            @if($student->enrollment_status === 'pending')
                                                <button class="btn bg-gradient-success btn-icon"
                                                        onclick="markReadyForEnrollment('{{ $student->id }}')"
                                                        title="Mark Ready for Enrollment">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            @endif
                                            
                                            <form id="delete-form-{{ $student->id }}" action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn bg-gradient-danger btn-icon"
                                                        onclick="confirmDelete('delete-form-{{ $student->id }}')"
                                                        title="Delete Student">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStudentModalLabel">Add New Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addStudentForm" action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="student_id" class="form-label">Student ID</label>
                        <input type="text" class="form-control @error('student_id') is-invalid @enderror" 
                               id="student_id" name="student_id" value="{{ old('student_id') }}" required>
                        @error('student_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="emailPrefix" name="emailPrefix" 
                                   placeholder="Enter student email prefix" required>
                            <span class="input-group-text">@student.buksu.edu.ph</span>
                        </div>
                        <input type="hidden" id="fullEmail" name="email">
                        <small class="form-text text-muted">Enter only the first part of the email address</small>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-icon" data-bs-dismiss="modal" title="Close">
                        <i class="fas fa-times"></i>
                    </button>
                    <button type="submit" class="btn bg-gradient-primary btn-icon" title="Add Student">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editStudentForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_student_id" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="edit_student_id" name="student_id" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-select" id="edit_status" name="status">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-icon" data-bs-dismiss="modal" title="Close">
                        <i class="fas fa-times"></i>
                    </button>
                    <button type="submit" class="btn bg-gradient-primary btn-icon" title="Save Changes">
                        <i class="fas fa-save"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if ($errors->any())
<script>
    let errorMessages = [];
    @foreach ($errors->all() as $error)
        errorMessages.push("{{ $error }}");
    @endforeach
    alert(errorMessages.join("\n"));
</script>
@endif

@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif

<!-- Delete confirmation -->
<script>
function confirmDelete(formId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This will permanently delete the student and prevent them from logging in. This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#7f1d1d',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete student!'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById(formId);
            
            fetch(form.action, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: data.message,
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
                    text: error.message || 'Error deleting student'
                });
            });
        }
    });
}
</script>

@push('scripts')
<script>
function updateEmail(prefix) {
    const suffix = '@student.buksu.edu.ph';
    const fullEmail = prefix + suffix;
    document.getElementById('fullEmail').value = fullEmail;
}

// Update form submission validation
function validateStudentForm() {
    const emailPrefix = document.getElementById('emailPrefix').value;
    const emailRegex = /^[0-9a-zA-Z._%+-]+@student\.buksu\.edu\.ph$/;
    
    if (!emailRegex.test(emailPrefix)) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Email',
            text: 'Please enter a valid email prefix'
        });
        return false;
    }
    
    updateEmail(emailPrefix);
    return true;
}

// Update your existing addStudent function
function addStudent() {
    if (!validateStudentForm()) {
        return;
    }
    // Rest of your existing addStudent function code
}

function editStudent(id, studentId, name, email, status) {
    // Set form action
    const form = document.getElementById('editStudentForm');
    form.action = `/students/${id}`;
    
    // Fill form fields
    document.getElementById('edit_student_id').value = studentId;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_status').value = status || 'active';
    
    // Show modal using Bootstrap Modal instance
    const editModal = new bootstrap.Modal(document.getElementById('editStudentModal'));
    editModal.show();
}

// Initialize DataTables
$(document).ready(function() {
    const studentsTable = $('#studentsTable').DataTable({
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
        },
        columnDefs: [
            {
                targets: -1, // Last column (Actions)
                orderable: false,
                searchable: false
            },
            {
                targets: 3, // Updated Status column index (was 5 before)
                orderable: true,
                searchable: true,
                render: function(data, type, row) {
                    if(type === 'display') {
                        return row[3]; // Updated index to match new column position
                    }
                    return $(row[3]).text(); // Updated index to match new column position
                }
            }
        ]
    });

    // Custom search functionality
    $('#customSearch').on('keyup', function() {
        studentsTable.search(this.value).draw();
    });
});

document.getElementById('addStudentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get form values
    const studentId = document.getElementById('student_id').value;
    const name = document.getElementById('name').value;
    const emailPrefix = document.getElementById('emailPrefix').value;
    const status = document.getElementById('status').value;

    // Validate student number format
    const studentNumberRegex = /^[0-9]{10}$/;  // Exactly 10 digits
    if (!studentNumberRegex.test(emailPrefix)) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Student Number',
            text: 'Please enter your 10-digit student number (e.g., 2201101589)'
        });
        return;
    }

    // Create full email
    const fullEmail = emailPrefix + '@student.buksu.edu.ph';
    document.getElementById('fullEmail').value = fullEmail;

    // Submit form via AJAX
    fetch(this.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            student_id: studentId,
            name: name,
            email: fullEmail,
            status: status
        })
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
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while adding the student'
        });
    });
});

// Add this new code after your existing scripts
document.getElementById('editStudentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    fetch(this.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: new FormData(this)
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
                text: data.message || 'Error updating student'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while updating the student'
        });
    });
});

function markReadyForEnrollment(studentId) {
    Swal.fire({
        title: 'Confirm',
        text: "Mark this student as ready for enrollment?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#4C1D95',
        cancelButtonColor: '#6B7280',
        confirmButtonText: 'Yes, mark as ready'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/students/${studentId}/mark-ready`, {
                method: 'POST',
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
                        title: 'Success!',
                        text: 'Student is now ready for enrollment',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                }
            });
        }
    });
}
</script>
@endpush

<style>
    /* Card and Header Styling */
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

    /* Button Styling */
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
        transition: all 0.3s ease;
    }

    .btn-icon i {
        color: var(--gold);
        font-size: 0.9rem;
    }

    /* Status Badge */
    .badge.bg-success {
        background: var(--gold) !important;
        color: var(--navy-blue);
        font-weight: 500;
    }

    .badge.bg-danger {
        background: rgba(220, 38, 38, 0.1) !important;
        color: #dc2626;
        border: 1px solid #dc2626;
        font-weight: 500;
    }

    /* Table Styling */
    .table thead th {
        color: var(--navy-blue);
        font-weight: 600;
        border-bottom: 2px solid var(--gold);
        text-transform: uppercase;
        font-size: 0.75rem;
        padding: 1rem;
    }

    /* Action Buttons */
    .btn.bg-gradient-warning {
        background: var(--navy-blue) !important;
        border: 2px solid var(--gold);
        color: var(--gold);
    }

    .btn.bg-gradient-warning:hover {
        background: var(--gold) !important;
        color: var(--navy-blue);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 215, 0, 0.2);
    }

    .btn.bg-gradient-warning:hover i {
        color: var(--navy-blue);
    }

    .btn.bg-gradient-success {
        background: var(--navy-blue) !important;
        border: 2px solid var(--gold);
        color: var(--gold);
    }

    .btn.bg-gradient-success:hover {
        background: var(--gold) !important;
        color: var(--navy-blue);
    }

    .btn.bg-gradient-danger {
        background: var(--navy-blue) !important;
        border: 2px solid #dc2626;
        color: #dc2626;
    }

    .btn.bg-gradient-danger:hover {
        background: #dc2626 !important;
        color: var(--white);
    }

    /* Modal Styling */
    .modal-header {
        background: var(--navy-blue);
        border-bottom: 2px solid var(--gold);
    }

    .modal-title {
        color: var(--white);
        font-weight: 500;
    }

    .modal-header .btn-close {
        color: var(--white);
        opacity: 0.8;
    }

    /* Form Controls */
    .form-label {
        color: var(--navy-blue);
        font-weight: 500;
    }

    .form-control:focus {
        border-color: var(--gold);
        box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.1);
    }

    .input-group-text {
        background: var(--navy-blue);
        color: var(--gold);
        border: 1px solid var(--gold);
    }

    /* Modal Footer Buttons */
    .modal-footer .btn-secondary {
        background: var(--navy-blue) !important;
        border: 2px solid var(--gold);
        color: var(--gold);
    }

    .modal-footer .btn-secondary:hover {
        background: var(--gold) !important;
        color: var(--navy-blue);
    }

    .modal-footer .btn-primary {
        background: var(--navy-blue) !important;
        border: 2px solid var(--gold);
        color: var(--gold);
    }

    .modal-footer .btn-primary:hover {
        background: var(--gold) !important;
        color: var(--navy-blue);
    }

    /* SweetAlert Customization */
    .swal2-confirm {
        background: var(--navy-blue) !important;
        border: 2px solid var(--gold) !important;
        color: var(--gold) !important;
    }

    .swal2-confirm:hover {
        background: var(--gold) !important;
        color: var(--navy-blue) !important;
    }

    /* DataTable Layout and Spacing */
    .dataTables_wrapper {
        padding: 1.5rem;
    }

    /* Show Entries Container */
    .dataTables_length select,
    select[name="studentsTable_length"] {
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

    /* Search Container */
    .dataTables_filter input {
        margin-left: 0.5rem;
        width: 220px;
        height: 36px;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        border: 1px solid var(--gold);
        border-radius: 6px;
        background-color: transparent;
        color: var(--navy-blue);
    }

    /* Pagination Container */
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
        font-size: 0.875rem;
        cursor: pointer;
        transition: all 0.2s ease;
        margin: 0 2px;
    }

    .paginate_button.current {
        background-color: var(--navy-blue);
        border-color: var(--navy-blue);
        color: var(--gold);
    }

    .paginate_button:hover:not(.current):not(.disabled) {
        background-color: var(--gold);
        border-color: var(--gold);
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