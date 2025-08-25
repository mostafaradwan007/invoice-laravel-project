<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | FatoraBee</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #fff9dc 0%, #ffe680 100%);
            font-family: 'Poppins', sans-serif;
            position: relative;
            overflow-x: hidden;
        }
        
        .login-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(255, 204, 0, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 204, 0, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 80%, rgba(255, 204, 0, 0.1) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        .login-box {
            position: relative;
            z-index: 2;
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 204, 0, 0.2);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        }
        
        .brand-logo {
            animation: pulse 2s ease-in-out infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #ffcc00, #ffd700);
            border: none;
            font-weight: 600;
            padding: 12px 24px;
            box-shadow: 0 4px 15px rgba(255, 204, 0, 0.3);
            transition: all 0.3s ease;
        }
        
        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 204, 0, 0.4);
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #bbb;
            transition: color 0.3s ease;
        }

        .toggle-password:hover {
            color: #000;
        }

        .form-floating input:focus {
            border-color: #ffd700;
            box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
        }
    </style>
</head>
<body>

<section class="login-section d-flex justify-content-center align-items-center min-vh-100">
    <div class="login-box p-4 shadow-lg bg-white rounded-4" style="max-width: 440px; width: 100%;">
        <div class="text-center mb-4">
            <div class="brand-logo mb-3">
                <i class="fas fa-receipt fa-4x text-warning"></i>
            </div>
            <h3 class="mb-1"><span class="text-dark">Fatora</span><span class="text-warning">Bee</span></h3>
            <p class="text-muted small">Welcome back! Sign in to your dashboard</p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger text-center">
                <ul class="mb-0" style="list-style: none; padding: 0;">
                    @foreach ($errors->all() as $error)
                        <li>❌ {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Success Messages -->
        @if (session('success'))
            <div class="alert alert-success text-center">
                ✅ {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       id="email" name="email" placeholder="you@example.com" 
                       value="{{ old('email') }}" required>
                <label for="email">Email address</label>
            </div>
            
            <div class="form-floating mb-3 position-relative">
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" placeholder="••••••••" required>
                <label for="password">Password</label>
                <i class="fas fa-eye toggle-password" id="togglePassword"></i>
            </div>
            
            <div class="form-check mb-3 text-start">
                <input class="form-check-input" type="checkbox" id="remember" name="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn btn-warning w-100 fw-bold">
                <i class="fas fa-sign-in-alt me-2"></i>Log in
            </button>
        </form>

        <div class="mt-3 text-center small text-muted">
            Don't have an account? 
            <a href="{{ route('signup') }}" class="text-warning fw-bold text-decoration-none">Create Account</a>
        </div>

        <div class="text-center my-3 text-muted">or sign in with</div>
        <div class="d-flex justify-content-between mb-3">
            <button type="button" class="btn btn-outline-danger w-100 me-2">
                <i class="fab fa-google me-2"></i>Google
            </button>
            <button type="button" class="btn btn-outline-dark w-100 ms-2">
                <i class="fab fa-github me-2"></i>GitHub
            </button>
        </div>

        <div class="text-center">
            <a href="#" class="text-decoration-none text-warning">Forgot password?</a>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Toggle password visibility
document.getElementById("togglePassword").addEventListener("click", function () {
    const passwordField = document.getElementById("password");
    const type = passwordField.type === "password" ? "text" : "password";
    passwordField.type = type;
    this.classList.toggle("fa-eye");
    this.classList.toggle("fa-eye-slash");
});

// Auto-hide alerts
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease-out';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });
});
</script>
</body>
</html>