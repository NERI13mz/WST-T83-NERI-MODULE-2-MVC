<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Student Information System') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        
        <style>
            :root {
                --navy-blue: #001f3f; /* Navy Blue */
                --gold: #FFD700; /* Gold */
                --light-gray: #f8f9fa; /* Light Gray for contrast */
                --white: #ffffff; /* White */
            }

            body {
                background-color: var(--light-gray);
                color: var(--navy-blue);
                font-family: 'Arial', sans-serif;
            }

            .navbar {
                background: var(--navy-blue);
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            .navbar-brand {
                color: var(--gold) !important;
                font-weight: bold;
            }

            .navbar-nav .nav-link {
                color: var(--white) !important;
                transition: color 0.3s;
            }

            .navbar-nav .nav-link:hover {
                color: var(--gold) !important;
            }

            .welcome-section {
                background: var(--navy-blue);
                color: var(--white);
                padding: 100px 0;
                text-align: center;
                border-radius: 0 0 20px 20px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            }

            .welcome-text {
                font-size: 2.5rem;
                font-weight: 600;
            }

            .text-gradient {
                background: linear-gradient(135deg, var(--gold) 0%, var(--white) 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                font-size: 3rem;
                font-weight: bold;
            }

            .btn-custom {
                background: var(--gold);
                color: var(--navy-blue);
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                font-weight: 500;
                transition: all 0.3s ease;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                margin: 0.5rem;
            }

            .btn-custom:hover {
                background: var(--navy-blue);
                color: var(--gold);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
            }

            @media (max-width: 768px) {
                .welcome-text {
                    font-size: 2rem;
                }

                .text-gradient {
                    font-size: 2.5rem;
                }
            }
        </style>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ms-auto">
                        @if (Route::has('login'))
                            @auth
                                @if(Auth::user()->user_type === 'student')
                                    <li class="nav-item">
                                        <a href="{{ route('student.dashboard') }}" class="btn btn-custom">
                                            <i class="fas fa-tachometer-alt"></i> Dashboard
                                        </a>
                                    </li>
                                @else
                                    <li class="nav-item">
                                        <a href="{{ route('dashboard') }}" class="btn btn-custom">
                                            <i class="fas fa-tachometer-alt"></i> Dashboard
                                        </a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item">
                                    <a href="{{ route('login') }}" class="btn btn-custom me-2">
                                        <i class="fas fa-sign-in-alt"></i> Log in
                                    </a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a href="{{ route('register') }}" class="btn btn-custom">
                                            <i class="fas fa-user-plus"></i> Register
                                        </a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Main Section -->
        <header class="welcome-section min-vh-100">
            <div class="container">
                <h1 class="welcome-text">Welcome to</h1>
                <h1 class="text-gradient">Student Information System</h1>
                <p class="lead mb-5">
                    This Laravel-based SIS manages students, subjects, enrollments, and grades with secure access.
                </p>
                @auth
                    @if(Auth::user()->user_type === 'student')
                        <a href="{{ route('student.dashboard') }}" class="btn btn-custom btn-lg">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-custom btn-lg">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Go to Dashboard
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-custom btn-lg">
                        <i class="fas fa-sign-in-alt me-2"></i>
                        Get Started
                    </a>
                @endguest
            </div>
        </header>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
