<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Student Information System') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600&display=swap" rel="stylesheet">
        
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
                font-family: 'Roboto', sans-serif; /* Modern font */
                margin: 0;
                padding: 0;
                overflow: hidden; /* Prevent scrolling */
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
                font-weight: 500; /* Slightly bolder */
                font-size: 1.1rem; /* Adjusted font size */
                margin-left: 20px; /* Increased margin for spacing */
            }

            .navbar-nav .nav-link:hover {
                color: var(--gold) !important;
            }

            .welcome-section {
                height: 100vh; /* Full viewport height */
                display: flex; /* Use flexbox for centering */
                flex-direction: column; /* Stack items vertically */
                justify-content: center; /* Center vertically */
                align-items: center; /* Center horizontally */
                text-align: center;
                background: linear-gradient(135deg, var(--navy-blue) 0%, var(--light-gray) 100%);
                border-radius: 0 0 20px 20px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                padding: 20px; /* Added padding for better spacing */
            }

            .welcome-text {
                font-size: 2.5rem;
                font-weight: 600;
                margin-bottom: 10px; /* Adjusted margin */
            }

            .solid-gold {
                color: var(--gold); /* Solid gold */
                font-size: 3rem;
                font-weight: bold;
                margin-bottom: 20px; /* Adjusted margin */
            }

            .btn-custom {
                background: var(--gold); /* Solid gold */
                color: var(--navy-blue);
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                font-weight: 500;
                transition: all 0.3s ease;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                margin: 0.5rem;
                box-shadow: 0 4px 12px rgba(255, 215, 0, 0.3);
            }

            .btn-custom:hover {
                background: darkgoldenrod; /* Darker gold on hover */
                color: var(--white);
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(255, 215, 0, 0.5);
            }

            .card {
                border: none;
                border-radius: 10px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            }

            .card-header {
                background: var(--navy-blue);
                color: var(--white);
                font-weight: bold;
            }

            .card-body {
                background: var(--white);
            }

            @media (max-width: 768px) {
                .welcome-text {
                    font-size: 2rem;
                }
            }
        </style>
    </head>
    <body>
        <header class="welcome-section">
            <div class="container">
                <h1 class="welcome-text">Welcome to</h1>
                <h1 class="solid-gold">Student Information System</h1>
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
