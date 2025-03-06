<x-guest-layout>
    <div class="card-header text-center bg-transparent">
        <h2 class="welcome-title">Forgot Password</h2>
    </div>

    <div class="px-4">
        <div class="mb-4 instruction-text">
            {{ __('To reset your password, please provide your email address.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-4">
                <label class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" name="email" class="form-control" 
                           value="{{ old('email') }}" required autofocus
                           placeholder="Enter your email">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <button type="submit" class="btn btn-gradient mb-4">
                Send Reset Link
            </button>

            <p class="text-center mb-0">
                Remember your password? 
                <a href="{{ route('login') }}" class="sign-in-link">
                    Back to login
                </a>
            </p>
        </form>
    </div>
</x-guest-layout>

<style>
    :root {
        --navy-blue: #001f3f;
        --navy-light: #003366;
        --gold: #FFD700;
        --gold-dark: #B8860B;
    }

    .welcome-title {
        background: linear-gradient(135deg, var(--navy-blue) 60%, var(--gold) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.4rem;
        letter-spacing: -0.5px;
    }

    .welcome-subtitle {
        font-size: 0.9rem;
        margin-bottom: 0;
        color: var(--navy-blue);
        opacity: 0.7;
        letter-spacing: -0.2px;
    }

    .instruction-text {
        color: var(--navy-blue);
        opacity: 0.8;
        font-size: 0.95rem;
        line-height: 1.5;
        text-align: center;
        padding: 0 1rem;
    }

    .form-label {
        color: var(--navy-blue);
        font-weight: 500;
        margin-bottom: 0.4rem;
    }

    .input-group {
        border: 2px solid rgba(0, 31, 63, 0.2);
        transition: all 0.3s ease;
        margin-bottom: 0.3rem;
        min-height: 45px;
        width: 100%;
        border-radius: 12px;
        overflow: hidden;
    }

    .input-group:hover {
        border-color: rgba(184, 134, 11, 0.4);
    }

    .input-group:focus-within {
        border-color: var(--gold);
        box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.15);
    }

    .input-group-text {
        padding: 0.625rem 1rem;
        background: transparent !important;
        border: none;
        color: var(--navy-blue);
        opacity: 0.7;
        font-size: 0.9rem;
    }

    .input-group-text i {
        transition: color 0.3s ease;
    }

    .input-group:focus-within .input-group-text i {
        color: var(--gold-dark) !important;
        opacity: 1;
    }

    .form-control {
        border: none;
        padding: 0.625rem 1rem;
        font-size: 0.9rem;
        width: 100%;
    }

    .form-control:focus {
        color: var(--navy-blue);
        background-color: transparent;
        border-color: transparent;
        outline: 0;
        box-shadow: none;
    }

    .btn-gradient {
        background: linear-gradient(
            135deg,
            var(--navy-blue) 0%,
            var(--navy-light) 85%,
            var(--gold-dark) 100%
        ) !important;
        border: none;
        position: relative;
        overflow: hidden;
        z-index: 1;
        color: white;
        font-weight: 600;
        padding: 0.625rem;
        margin: 0.5rem 0 1rem;
        min-height: 45px;
        font-size: 1rem;
        width: 100%;
        border-radius: 12px;
    }

    .btn-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(
            135deg,
            var(--navy-light) 0%,
            var(--gold) 100%
        );
        opacity: 0;
        transition: opacity 0.3s ease;
        z-index: -1;
    }

    .btn-gradient:hover::before {
        opacity: 1;
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 31, 63, 0.3);
        color: var(--navy-blue);
    }

    .sign-in-link {
        color: var(--gold-dark);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .sign-in-link:hover {
        color: var(--navy-blue);
    }

    .mt-2 {
        margin-top: 0.2rem !important;
        font-size: 0.75rem;
    }

    p.text-center {
        margin-top: 0.25rem;
        font-size: 0.85rem;
    }
</style>
