@extends('layouts.dashboardTemp')

@section('title', 'Dashboard')
@section('Pages', 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <h2 class="page-title">Students Overview</h2>
            <p class="page-subtitle">Monitor student statistics and activities</p>
        </div>
    </div>

    <div class="d-flex align-items-center gap-5 justify-content-center flex-wrap">
        <!-- Total Students Stats -->
        <div class="stat-container">
            <div class="card stat-card">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <div class="numbers">
                                <p class="stat-label">Total Students</p>
                                <h3 class="stat-value">
                                    {{ $totalStudents }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-5 d-flex justify-content-center">
                            <div class="icon-shape">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Students Stats -->
        <div class="stat-container">
            <div class="card stat-card">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-7">
                            <div class="numbers">
                                <p class="stat-label">Active Students</p>
                                <h3 class="stat-value">
                                    {{ $activeStudents }}
                                </h3>
                            </div>
                        </div>
                        <div class="col-5 d-flex justify-content-center">
                            <div class="icon-shape">
                                <i class="fas fa-user-graduate"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Recent Students</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7">Student ID</th>
                                    <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                                    <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                    <th class="text-uppercase text-white text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentStudents as $student)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $student->student_id }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $student->name }}</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">{{ $student->email }}</p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-gradient-{{ $student->status === 'active' ? 'success' : 'secondary' }}">
                                            {{ $student->status }}
                                        </span>
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

<!-- Add Subject Modal -->
@include('Subjects.partials.add-subject-modal')

@push('scripts')
<script>

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
                window.location.href = '{{ route("subjects.index") }}';
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
</script>
@endpush

<style>
    :root {
        --navy-blue: #001f3f;
        --gold: #FFD700;
        --white: #ffffff;
    }

    .card {
        background: var(--white);
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    }

    .numbers p {
        font-size: 0.875rem;
        letter-spacing: 0.5px;
    }

    .numbers h5 {
        font-size: 1.75rem;
        margin-top: 0.5rem;
    }

    .icon-shape {
        width: 45px;
        height: 45px;
        background: rgba(0, 31, 63, 0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-shape i {
        color: var(--navy-blue) !important;
        font-size: 1.25rem;
    }

    .fw-bold {
        font-weight: 600 !important;
    }

    .btn.bg-gradient-primary {
        background: linear-gradient(310deg, #5e72e4, #825ee4);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
        border-radius: 0.75rem;
        margin-bottom: 1rem;
    }

    .btn.bg-gradient-primary:hover {
        background: linear-gradient(310deg, #825ee4, #5e72e4);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(94, 114, 228, 0.3);
    }

    .btn.bg-gradient-primary i {
        margin-right: 0.5rem;
        color: white;
    }

    /* Color Variables */
    :root {
        --navy-blue: #001f3f; /* Navy Blue */
        --gold: #FFD700; /* Gold */
        --light-gray: #f8f9fa; /* Light Gray for contrast */
        --white: #ffffff; /* White */
    }

    /* Card Styling */
    .card {
        background: var(--white);
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(234, 88, 12, 0.15);
    }

    .card-header {
        background: linear-gradient(310deg, var(--navy-blue), var(--gold));
        color: var(--white);
        border: none;
    }

    /* Table Styling */
    .table thead th {
        background: var(--navy-blue);
        color: var(--white);
        border-bottom: none;
    }

    .table tbody tr:hover {
        background: rgba(234, 88, 12, 0.05);
    }

    /* Badge Styling */
    .bg-gradient-success {
        background: linear-gradient(310deg, #059669, #10b981);
    }

    .bg-gradient-secondary {
        background: linear-gradient(310deg, #4b5563, #6b7280);
    }

    /* Text Styling */
    .text-xs {
        color: var(--navy-blue);
    }

    .text-sm {
        font-weight: 500;
    }

    /* Stats Card */
    .stats-card {
        border-radius: 1rem;
        transition: all 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 7px 14px rgba(50, 50, 93, 0.1), 0 3px 6px rgba(0, 0, 0, 0.08);
    }

    .bg-gradient-primary {
        background: linear-gradient(310deg, #5e72e4, #825ee4);
    }

    .bg-gradient-success {
        background: linear-gradient(310deg, #2dce89, #2dcecc);
    }

    .icon-shape {
        width: 48px;
        height: 48px;
        background: rgba(255, 215, 0, 0.15);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--gold);
        transition: all 0.3s ease;
    }

    .icon-shape i {
        color: var(--gold) !important;
        font-size: 1.25rem;
    }

    .stat-card:hover .icon-shape {
        background: var(--gold);
    }

    .stat-card:hover .icon-shape i {
        color: var(--navy-blue) !important;
    }

    .text-primary {
        color: #5e72e4 !important;
    }

    .text-success {
        color: #2dce89 !important;
    }

    /* Stats Card Styling */
    .stats-card {
        border-radius: 1rem;
        transition: all 0.3s ease;
    }

    .stats-card .icon-shape {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stats-card .icon-shape i {
        font-size: 1.25rem;
        line-height: 1;
    }

    .shadow-light {
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
    }

    /* Navigation Button Styling */
    .navbar-nav .nav-link {
        padding: 0.75rem 1rem;
        margin: 0.5rem 1rem;
        border-radius: 0.5rem;
        width: calc(100% - 2rem);
        transition: all 0.3s ease;
    }

    .navbar-nav .nav-item {
        width: 100%;
    }

    .navbar-nav .icon-shape {
        width: 32px;
        height: 32px;
    }

    .card-header h6 {
        color: white !important;
    }

    .modal-footer .btn.bg-gradient-primary {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        margin-bottom: 0;
        border-radius: 0.5rem;
    }

    .modal-footer .btn.bg-gradient-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 8px rgba(94, 114, 228, 0.2);
    }

    /* Icon-only button styles */
    .btn-icon {
        width: 38px !important;
        height: 38px !important;
        padding: 0 !important;
        min-width: unset !important;
        border-radius: 8px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        margin: 0 4px !important;
    }

    .btn-icon i {
        font-size: 16px !important;
        margin: 0 !important;
    }

    /* Remove margin bottom for quick action buttons */
    .col-xl-6 .btn-icon {
        margin-bottom: 0 !important;
    }

    /* Secondary button style */
    .btn.btn-secondary.btn-icon {
        background: #6B7280 !important;
        color: white !important;
    }

    .btn.btn-secondary.btn-icon:hover {
        background: #4B5563 !important;
    }

    /* Hover effects */
    .btn-icon:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(94, 114, 228, 0.3);
    }

    /* Page Title Styling */
    .page-title {
        color: var(--navy-blue);
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        font-family: 'Inter', sans-serif;
    }

    .page-subtitle {
        color: #6B7280;
        font-size: 0.95rem;
        margin-bottom: 2rem;
        font-family: 'Inter', sans-serif;
    }

    /* Card Styling */
    .stat-card {
        background: linear-gradient(135deg, var(--navy-blue), #002c59) !important;
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 31, 63, 0.15);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 31, 63, 0.2);
    }

    /* Text Styling */
    .stat-label {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.875rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        color: var(--white);
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        line-height: 1.2;
    }

    /* Card Body Spacing */
    .card-body {
        padding: 1.5rem !important;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .stat-value {
            font-size: 1.75rem;
        }

        .icon-shape {
            width: 42px;
            height: 42px;
        }
    }

    /* Container Spacing */
    .container-fluid {
        padding: 2rem 2.5rem;
    }

    /* Card Container Spacing */
    .row.g-4 {
        --bs-gutter-x: 2rem;
        --bs-gutter-y: 2rem;
        margin-right: calc(var(--bs-gutter-x) * -.5);
        margin-left: calc(var(--bs-gutter-x) * -.5);
    }

    /* Responsive Spacing */
    @media (max-width: 768px) {
        .row.g-4 {
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 1.5rem;
        }
    }

    .stat-container {
        width: 380px;
        max-width: 100%;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .d-flex.gap-5 {
            gap: 1.5rem !important;
        }
        
        .stat-container {
            width: 100%;
            max-width: 340px;
        }
    }
</style>
@endsection