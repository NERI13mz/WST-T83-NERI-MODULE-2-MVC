<x-guest-layout>
    <div class="card-header text-center bg-transparent">
        <h2 class="welcome-title">Create Account</h2>
        <p class="welcome-subtitle">Sign up to get started</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="px-4">
        @csrf
        <div class="mb-4">
            <label class="form-label">Full Name</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-user"></i>
                </span>
                <input type="text" name="name" class="form-control" 
                       value="{{ old('name') }}" required autofocus
                       placeholder="Enter your full name">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label class="form-label">Email Address</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </span>
                <input type="email" name="email" class="form-control" 
                       value="{{ old('email') }}" required
                       placeholder="Enter your email">
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <small class="text-muted">Use your BukSU email address</small>
        </div>

        <div class="mb-4">
            <label class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                </span>
                <input type="password" name="password" id="password" 
                       class="form-control" required
                       placeholder="Enter your password">
                <span class="password-toggle-icon" onclick="togglePassword('password', 'togglePassword')">
                    <i class="fas fa-eye" id="togglePassword"></i>
                </span>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mb-4">
            <label class="form-label">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                </span>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="form-control" required
                       placeholder="Confirm your password">
                <span class="password-toggle-icon" onclick="togglePassword('password_confirmation', 'togglePasswordConfirm')">
                    <i class="fas fa-eye" id="togglePasswordConfirm"></i>
                </span>
            </div>
        </div>

        <button type="submit" class="btn btn-gradient mb-4">
            Create Account
        </button>

        <p class="text-center mb-0">
            Already have an account? 
            <a href="{{ route('login') }}" class="sign-in-link">
                Sign in
            </a>
        </p>
    </form>
</x-guest-layout>

<style>
    :root {
        --navy-blue: #001f3f;
        --navy-light: #003366;
        --gold: #FFD700;
        --gold-dark: #B8860B;
    }

    .container {
        max-width: 460px !important;
        margin: 1rem;
    }

    .card {
        padding: 2rem !important;
        background: rgba(255, 255, 255, 0.98);
        border-radius: 20px;
        box-shadow: 
            0 20px 40px rgba(0, 0, 0, 0.2),
            0 0 0 1px rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        width: 100%;
    }

    .card-header {
        padding: 0 1rem 0.75rem;
        margin-bottom: 1.5rem;
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

    .form-label {
        color: var(--navy-blue);
        font-weight: 500;
        margin-bottom: 0.4rem;
    }

    .mb-4 {
        margin-bottom: 1.25rem !important;
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
        border-color: rgba(184, 134, 11, 0.4); /* Light gold on hover */
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

    .password-toggle-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        z-index: 10;
        color: var(--navy-blue);
        opacity: 0.7;
        padding: 5px;
    }

    .password-toggle-icon:hover {
        opacity: 1;
    }

    .input-group:focus-within .password-toggle-icon {
        color: var(--gold-dark);
        opacity: 1;
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

    .text-muted {
        font-size: 0.75rem;
        margin-top: 0.2rem;
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

    form.px-4 {
        padding: 0 1.5rem !important;
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

<script>
    function togglePassword(inputId, toggleIconId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(toggleIconId);
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>
