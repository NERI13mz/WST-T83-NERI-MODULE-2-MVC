<x-guest-layout>
    <div class="card-header text-center bg-transparent">
        <h2 class="welcome-title">Welcome</h2>
        <p class="welcome-subtitle">Sign in to your account to continue</p>
    </div>
    
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <form method="POST" action="{{ route('login') }}" class="px-4">
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

        <div class="mb-4">
            <label class="form-label">Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fas fa-lock"></i>
                </span>
                <input type="password" name="password" id="password" 
                       class="form-control" required 
                       placeholder="Enter your password">
                <span class="password-toggle-icon" onclick="togglePassword()">
                    <i class="fas fa-eye" id="togglePassword"></i>
                </span>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="auth-options">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                <label class="form-check-label" for="remember_me">
                    Remember me
                </label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="forgot-password">
                    Forgot password?
                </a>
            @endif
        </div>

        <button type="submit" class="btn btn-gradient mb-4">
            Sign In
        </button>

        <p class="text-center mb-0">
            Don't have an account? 
            <a href="{{ route('register') }}" class="create-account-link">
                Create Account
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

    .welcome-title {
        background: linear-gradient(
            135deg,
            var(--navy-blue) 0%,
            var(--navy-blue) 60%,
            var(--gold) 100%
        );
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.4rem;
        letter-spacing: -0.5px;
        display: inline-block;
    }

    .welcome-subtitle {
        font-size: 0.9rem;
        margin-bottom: 0;
        color: var(--navy-blue);
        opacity: 0.7;
        letter-spacing: -0.2px;
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

    .input-group {
        border: 2px solid rgba(0, 31, 63, 0.2);
        transition: all 0.3s ease;
    }

    .input-group:hover {
        border-color: rgba(184, 134, 11, 0.4);
    }

    .input-group:focus-within {
        border-color: var(--gold);
        box-shadow: 0 0 0 2px rgba(255, 215, 0, 0.15);
    }

    .input-group-text i {
        transition: color 0.3s ease;
    }

    .input-group:focus-within .input-group-text i {
        color: var(--gold-dark) !important;
        opacity: 1;
    }

    .form-control:focus {
        color: var(--navy-blue);
        background-color: transparent;
        border-color: transparent;
        outline: 0;
        box-shadow: none;
    }

    .form-check-input:checked {
        background-color: var(--navy-blue);
        border-color: var(--navy-blue);
    }

    .forgot-password {
        color: var(--navy-blue);
        opacity: 0.8;
        transition: all 0.3s ease;
    }

    .forgot-password:hover {
        color: var(--gold-dark);
        opacity: 1;
    }

    .create-account-link {
        color: var(--gold-dark);
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .create-account-link:hover {
        color: var(--navy-blue);
    }
</style>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('togglePassword');
        
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
