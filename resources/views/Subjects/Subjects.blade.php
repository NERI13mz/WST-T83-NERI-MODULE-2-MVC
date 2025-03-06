@extends('layouts.dashboardTemp')
@section('title', 'Subjects')
@section('Pages')
    <span style="font-weight: 500;">Subjects</span>
@endsection
@section('content')
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-4 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0 gradient-title">Subject Lists</h6>
                        </div>
                        <button type="button" class="btn bg-gradient-primary btn-icon" 
                                data-bs-toggle="modal" 
                                data-bs-target="#addSubjectModal"
                                title="Add New Subject">
                            <i class="fas fa-book"></i>
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>Subject Code</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Units</th>
                                        <th>Schedule</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subjects as $subject)
                                    <tr>
                                        <td>{{ $subject->subject_code }}</td>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->description }}</td>
                                        <td>{{ $subject->units }}</td>
                                        <td>{{ $subject->schedule }}</td>
                                        <td>
                                            <span class="badge badge-sm bg-gradient-{{ $subject->deleted_at ? 'warning' : 'success' }}">
                                                {{ $subject->deleted_at ? 'Archived' : 'Active' }}
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn bg-gradient-warning btn-icon" 
                                                    title="Edit Subject"
                                                    onclick="editSubject('{{ $subject->id }}', '{{ $subject->subject_code }}', '{{ $subject->name }}', '{{ $subject->description }}', '{{ $subject->units }}', '{{ $subject->schedule }}')">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                            <form id="delete-form-{{ $subject->id }}" action="{{ route('subjects.destroy', $subject) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn bg-gradient-danger btn-icon"
                                                        title="Delete Subject"
                                                        onclick="confirmDelete('delete-form-{{ $subject->id }}')">
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

<!-- Add Subject Modal -->
<div class="modal fade" id="addSubjectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addSubjectForm" action="{{ route('subjects.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Subject Code</label>
                        <input type="text" class="form-control" name="subject_code" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Units</label>
                        <input type="number" class="form-control" name="units" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Schedule</label>
                        <input type="text" class="form-control" name="schedule">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-icon" data-bs-dismiss="modal" title="Close">
                        <i class="fas fa-times"></i>
                    </button>
                    <button type="submit" class="btn bg-gradient-primary btn-icon" title="Add Subject">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Subject Modal -->
<div class="modal fade" id="editSubjectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editSubjectForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Subject Code</label>
                        <input type="text" class="form-control" name="subject_code" id="edit_subject_code" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="edit_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="edit_description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Units</label>
                        <input type="number" class="form-control" name="units" id="edit_units" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Schedule</label>
                        <input type="text" class="form-control" name="schedule" id="edit_schedule">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-icon" data-bs-dismiss="modal" title="Close">
                        <i class="fas fa-times"></i>
                    </button>
                    <button type="submit" class="btn bg-gradient-warning btn-icon" title="Save Changes">
                        <i class="fas fa-save"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function editSubject(id, subject_code, name, description, units, schedule) {
    const form = document.getElementById('editSubjectForm');
    form.action = `/subjects/${id}`;
    
    document.getElementById('edit_subject_code').value = subject_code;
    document.getElementById('edit_name').value = name;
    document.getElementById('edit_description').value = description;
    document.getElementById('edit_units').value = units;
    document.getElementById('edit_schedule').value = schedule;
    
    const editModal = new bootstrap.Modal(document.getElementById('editSubjectModal'));
    editModal.show();
}

function confirmDelete(formId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#7f1d1d',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById(formId);
            const submitButton = form.querySelector('button[type="button"]');
            submitButton.disabled = true;
            
            const formData = new FormData();
            formData.append('_method', 'DELETE');
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(async response => {
                const contentType = response.headers.get('content-type');
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    // If response is not JSON, handle it as a successful delete
                    if (response.ok) {
                        return { success: true, message: 'Subject deleted successfully' };
                    }
                    throw new Error('Failed to delete subject');
                }
            })
            .then(data => {
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Subject has been deleted successfully.',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    location.reload();
                });
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'Error deleting subject'
                });
            })
            .finally(() => {
                submitButton.disabled = false;
            });
        }
    });
    return false;
}

// Add Subject Form Handler
document.getElementById('addSubjectForm').addEventListener('submit', function(e) {
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
                text: data.message || 'Error adding subject'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error adding subject'
        });
    })
    .finally(() => {
        submitButton.disabled = false;
    });
});

// Edit Subject Form Handler
document.getElementById('editSubjectForm').addEventListener('submit', function(e) {
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
                text: data.message || 'Error updating subject'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error updating subject'
        });
    })
    .finally(() => {
        submitButton.disabled = false;
    });
});
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

    /* Add Button Styling */
    .btn.bg-gradient-primary {
        background: var(--navy-blue) !important;
        border: 2px solid var(--gold);
        color: var(--gold);
        transition: all 0.3s ease;
    }

    .btn.bg-gradient-primary:hover {
        background: var(--gold) !important;
        color: var(--navy-blue);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 215, 0, 0.2);
    }

    /* Action Buttons */
    .btn-icon {
        width: 36px;
        height: 36px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--gold);
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    /* Edit Button */
    .btn.bg-gradient-warning {
        background: var(--navy-blue) !important;
        border: 2px solid var(--gold);
    }

    .btn.bg-gradient-warning i {
        color: var(--gold);
    }

    .btn.bg-gradient-warning:hover {
        background: var(--gold) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 215, 0, 0.2);
    }

    .btn.bg-gradient-warning:hover i {
        color: var(--navy-blue);
    }

    /* Delete Button */
    .btn.bg-gradient-danger {
        background: var(--navy-blue) !important;
        border: 2px solid #dc2626;
    }

    .btn.bg-gradient-danger i {
        color: #dc2626;
    }

    .btn.bg-gradient-danger:hover {
        background: #dc2626 !important;
        border-color: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
    }

    .btn.bg-gradient-danger:hover i {
        color: var(--white);
    }

    /* Status Badge */
    .badge.bg-gradient-success {
        background: var(--gold) !important;
        color: var(--navy-blue);
        font-weight: 500;
    }

    .badge.bg-gradient-warning {
        background: rgba(255, 215, 0, 0.2) !important;
        color: var(--gold);
        font-weight: 500;
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

    /* Table Styling */
    .table thead th {
        color: var(--navy-blue);
        font-weight: 600;
        border-bottom: 2px solid var(--gold);
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