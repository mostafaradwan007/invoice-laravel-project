<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | FatoraBee</title>
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
        
        .signup-section::before {
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
            animation: float 25s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(1deg); }
        }
        
        .signup-box {
            position: relative;
            z-index: 2;
            backdrop-filter: blur(20px);
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 204, 0, 0.2);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .signup-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
        }
        
        .brand-icon {
            animation: bounce 2s ease-in-out infinite;
            font-size: 3.5rem;
            background: linear-gradient(135deg, #ffcc00, #ffd700);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #ffcc00, #ffd700);
            border: none;
            font-weight: 600;
            padding: 12px 24px;
            box-shadow: 0 4px 15px rgba(255, 204, 0, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-warning::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }
        
        .btn-warning:hover::before {
            left: 100%;
        }
        
        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 204, 0, 0.4);
        }
        
        .form-floating input:focus {
            border-color: #ffcc00;
            box-shadow: 0 0 0 0.2rem rgba(255, 204, 0, 0.25);
        }
        
        .progress-bar {
            height: 3px;
            background: linear-gradient(90deg, #ffcc00, #ffd700);
            border-radius: 2px;
            margin: 10px 0;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }
        
        .progress-bar.show {
            transform: scaleX(1);
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #bbb;
            transition: color 0.3s ease;
            z-index: 10;
        }

        .toggle-password:hover {
            color: #000;
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
    </style>
</head>
<body>

<div class="theme-toggle">
    <button id="modeToggle" class="btn btn-outline-dark rounded-pill">🌙</button>
</div>

<section class="signup-section d-flex justify-content-center align-items-center min-vh-100 py-5">
    <div class="signup-box p-5 rounded-4" style="max-width: 500px; width: 100%;">
        <div class="text-center mb-4">
            <i class="fas fa-receipt brand-icon"></i>
            <h3 class="fw-bold mt-2"><span class="text-dark">Fatora</span><span class="text-warning">Bee</span></h3>
            <p class="text-muted">Create your account and start managing invoices!</p>
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
                🎉 {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('signup') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-floating mb-3">
    <input type="text" name="name" id="name" 
           class="form-control @error('name') is-invalid @enderror" 
           placeholder="Full Name" value="{{ old('name') }}" required>
    <label for="name"><i class="fas fa-user me-2"></i>Full Name</label>
</div>

            
            <div class="form-floating mb-3">
                <input type="email" name="email" id="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       placeholder="name@example.com" value="{{ old('email') }}" required>
                <label for="email"><i class="fas fa-envelope me-2"></i>Email address</label>
            </div>
            
            <div class="form-floating mb-3 position-relative">
                <input type="password" name="password" id="password" 
                       class="form-control @error('password') is-invalid @enderror" 
                       placeholder="Password" required>
                <label for="password"><i class="fas fa-lock me-2"></i>Password (min 6 characters)</label>
                <i class="fas fa-eye toggle-password" id="togglePassword"></i>
            </div>
            
            <div class="form-floating mb-3 position-relative">
                <input type="password" name="password_confirmation" id="password_confirmation" 
                       class="form-control @error('password_confirmation') is-invalid @enderror" 
                       placeholder="Confirm Password" required>
                <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Confirm Password</label>
                <i class="fas fa-eye toggle-password" id="togglePasswordConfirm"></i>
            </div>
            
            <div class="mb-3">
                <label class="form-label"><i class="fas fa-image me-2"></i>Profile Image (optional)</label>
                <input type="file" name="profile_image" 
                       class="form-control @error('profile_image') is-invalid @enderror" 
                       accept="image/jpeg,image/jpg,image/png,image/gif">
                <div class="form-text">Max size: 5MB. Formats: JPG, PNG, GIF</div>
            </div>
            
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="terms" required>
                <label class="form-check-label" for="terms">
                    I agree to the <a href="#" class="text-warning text-decoration-underline">Terms of Service</a> and 
                    <a href="#" class="text-warning text-decoration-underline">Privacy Policy</a>
                </label>
            </div>

            <button type="submit" class="btn btn-warning w-100 fw-bold py-2 mb-3" id="submitBtn">
                <i class="fas fa-user-plus me-2"></i>Create Account
            </button>
            
            <div class="progress-bar" id="progressBar"></div>
            
            <div id="loadingState" class="text-center mt-3" style="display: none;">
                <div class="spinner-border text-warning" role="status"></div>
                <p class="mt-2 text-muted">Creating your account...</p>
            </div>
        </form>

        <div class="text-center text-muted mb-3">or sign up with</div>
        <div class="d-flex justify-content-between mb-4">
            <button type="button" class="btn btn-outline-danger w-50 me-2">
                <i class="fab fa-google me-2"></i>Google
            </button>
            <button type="button" class="btn btn-outline-dark w-50">
                <i class="fab fa-github me-2"></i>GitHub
            </button>
        </div>

        <div class="text-center">
            <p>Already have an account? 
                <a href="{{ route('login') }}" class="text-warning fw-bold text-decoration-none">Sign In</a>
            </p>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Toggle password visibility
document.getElementById("togglePassword")?.addEventListener("click", function () {
    const passwordField = document.getElementById("password");
    const type = passwordField.type === "password" ? "text" : "password";
    passwordField.type = type;
    this.classList.toggle("fa-eye");
    this.classList.toggle("fa-eye-slash");
});

document.getElementById("togglePasswordConfirm")?.addEventListener("click", function () {
    const passwordField = document.getElementById("password_confirmation");
    const type = passwordField.type === "password" ? "text" : "password";
    passwordField.type = type;
    this.classList.toggle("fa-eye");
    this.classList.toggle("fa-eye-slash");
});

// Enhanced form submission with loading state
document.querySelector('form').addEventListener("submit", function (e) {
    const submitBtn = document.getElementById("submitBtn");
    const loadingState = document.getElementById("loadingState");
    const progressBar = document.getElementById("progressBar");
    
    // Show loading state
    submitBtn.style.display = 'none';
    loadingState.style.display = 'block';
    progressBar.classList.add('show');
});

// Password strength indicator
document.getElementById("password").addEventListener("input", function() {
    const password = this.value;
    const progressBar = document.getElementById("progressBar");
    
    if (password.length >= 8) {
        progressBar.classList.add('show');
        progressBar.style.background = 'linear-gradient(90deg, #10b981, #34d399)';
    } else if (password.length >= 6) {
        progressBar.classList.add('show');
        progressBar.style.background = 'linear-gradient(90deg, #f59e0b, #fbbf24)';
    } else if (password.length >= 3) {
        progressBar.classList.add('show');
        progressBar.style.background = 'linear-gradient(90deg, #ef4444, #f87171)';
    } else {
        progressBar.classList.remove('show');
    }
});

// Auto-hide alerts
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        if (alert.classList.contains('alert-success')) {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }, 8000);
        } else {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease-out';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            }, 5000);
        }
    });
});

// Theme toggle
document.getElementById("modeToggle")?.addEventListener("click", function () {
    document.body.classList.toggle("theme-dark");
    this.innerHTML = document.body.classList.contains("theme-dark") ? "☀️" : "🌙";
});

// Password confirmation validation
document.getElementById("password_confirmation").addEventListener("input", function() {
    const password = document.getElementById("password").value;
    const confirmPassword = this.value;
    
    if (confirmPassword && password !== confirmPassword) {
        this.setCustomValidity("Passwords don't match");
        this.classList.add("is-invalid");
    } else {
        this.setCustomValidity("");
        this.classList.remove("is-invalid");
    }
});
</script>

</body>
</html>