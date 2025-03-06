<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        
        <style>
            :root {
                --navy-blue: #001f3f;
                --gold: #FFD700;
                --gold-dark: #B8860B;
                --white: #ffffff;
                --gray-100: #f8f9fa;
                --gray-200: #e9ecef;
                --gray-300: #dee2e6;
                --font-primary: 'Inter', sans-serif;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                background: linear-gradient(
                    135deg,
                    var(--navy-blue) 0%,
                    #002c59 75%,
                    var(--gold-dark) 100%
                );
                font-family: var(--font-primary);
                position: relative;
                overflow: hidden;
            }

            body::before {
                content: '';
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: radial-gradient(
                    circle at 50% 50%,
                    rgba(0, 31, 63, 0.7) 0%,
                    rgba(0, 44, 89, 0.8) 60%,
                    rgba(184, 134, 11, 0.2) 100%
                );
                backdrop-filter: blur(45px);
                z-index: -1;
            }

            .light-effect {
                position: fixed;
                border-radius: 50%;
                filter: blur(120px);
                z-index: -1;
            }

            .light-1 {
                top: -10%;
                right: -5%;
                width: 40vw;
                height: 40vw;
                background: radial-gradient(
                    circle at center,
                    rgba(255, 215, 0, 0.08),
                    transparent 70%
                );
            }

            .light-2 {
                bottom: -20%;
                left: -5%;
                width: 70vw;
                height: 70vw;
                background: radial-gradient(
                    circle at center,
                    rgba(0, 31, 63, 0.4),
                    transparent 70%
                );
            }

            .light-3 {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 120vw;
                height: 120vh;
                background: radial-gradient(
                    ellipse at center,
                    rgba(0, 31, 63, 0.3) 0%,
                    rgba(184, 134, 11, 0.05) 50%,
                    transparent 70%
                );
                filter: blur(70px);
                z-index: -1;
            }

            .container {
                width: 100%;
                max-width: 420px;
                margin: 1.5rem;
                perspective: 1000px;
                position: relative;
                z-index: 1;
            }

            .card {
                background: rgba(255, 255, 255, 0.98);
                border-radius: 20px;
                padding: 2.5rem;
                box-shadow: 
                    0 20px 40px rgba(0, 0, 0, 0.2),
                    0 0 0 1px rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                transform-style: preserve-3d;
                transition: all 0.3s ease;
            }

            .card:hover {
                transform: translateY(-5px);
            }

            .card-header {
                margin-bottom: 2rem;
            }

            .form-label {
                display: block;
                margin-bottom: 0.5rem;
                font-size: 0.875rem;
                font-weight: 500;
                color: var(--navy-blue);
            }

            .input-group {
                position: relative;
                margin-bottom: 1.5rem;
                border-radius: 12px;
                background-color: var(--white);
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                border: 2px solid var(--navy-blue);
                overflow: hidden;
            }

            .input-group:hover,
            .input-group:focus-within {
                border-color: var(--gold);
            }

            .input-group:focus-within {
                box-shadow: 0 0 0 1px var(--gold);
            }

            .input-group-text {
                position: relative;
                left: 0;
                padding: 0.75rem 1rem;
                color: var(--navy-blue);
                z-index: 10;
                display: flex;
                align-items: center;
                background: transparent;
            }

            .form-control {
                width: 100%;
                padding: 0.75rem 1rem;
                border: none;
                background: transparent;
                font-size: 0.95rem;
                color: var(--navy-blue);
                border-radius: 0;
            }

            .form-control:focus {
                outline: none;
            }

            .password-toggle-icon {
                position: relative;
                padding: 0.75rem 1rem;
                color: var(--navy-blue);
                cursor: pointer;
                z-index: 10;
                display: flex;
                align-items: center;
                background: transparent;
            }

            .password-toggle-icon:hover {
                color: var(--gold);
            }

            .auth-options {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1.5rem;
            }

            .form-check {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                margin: 0;
            }

            .form-check-input {
                width: 1rem;
                height: 1rem;
                border-radius: 4px;
                border: 2px solid var(--navy-blue);
                cursor: pointer;
            }

            .form-check-input:checked {
                background-color: var(--navy-blue);
                border-color: var(--navy-blue);
            }

            .form-check-label {
                font-size: 0.875rem;
                color: var(--navy-blue);
            }

            .btn {
                width: 100%;
                padding: 0.875rem;
                border: none;
                border-radius: 12px;
                background-color: var(--navy-blue);
                color: var(--white);
                font-weight: 600;
                font-size: 1rem;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .btn:hover {
                background-color: var(--gold);
                color: var(--navy-blue);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0, 31, 63, 0.2);
            }

            .forgot-password {
                color: var(--navy-blue);
                font-size: 0.875rem;
                text-decoration: none;
                font-weight: 500;
            }

            .forgot-password:hover {
                color: var(--gold);
            }

            .create-account-link {
                color: var(--gold);
                font-weight: 600;
            }

            .create-account-link:hover {
                color: var(--gold-dark);
            }

            .welcome-title {
                color: var(--navy-blue);
                font-size: 1.75rem;
                font-weight: 600;
                margin-bottom: 0.5rem;
            }

            .welcome-subtitle {
                color: var(--gray-300);
                font-size: 0.95rem;
                margin-bottom: 2rem;
            }

            .text-center {
                text-align: center;
            }

            .mb-4 {
                margin-bottom: 1.5rem;
            }

            @media (max-width: 480px) {
                .container {
                    margin: 1rem;
                }

                .card {
                    padding: 2rem;
                }
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="light-effect light-1"></div>
        <div class="light-effect light-2"></div>
        <div class="light-effect light-3"></div>
        <div class="container">
            <div class="card">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
