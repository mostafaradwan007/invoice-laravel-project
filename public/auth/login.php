<?php

require_once '../../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once '../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

// استخدام Laravel
use App\Helpers\AuthHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

AuthHelper::start_secure_session();

// إعادة التوجيه للداشبورد إذا كان مسجل دخول
if (AuthHelper::is_logged_in()) {
    header("Location: ../dashboard/index.php");
    exit;
}

$message = "";
$login_attempts = Session::get('login_attempts', 0);
$last_attempt = Session::get('last_attempt', 0);

// Check for too many login attempts
if ($login_attempts >= 5 && (time() - $last_attempt) < 300) {
    $remaining_time = 300 - (time() - $last_attempt);
    $message = "<div class='alert alert-warning text-center mt-3'>⚠️ Too many failed attempts. Try again in " . ceil($remaining_time/60) . " minutes.</div>";
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    if ((time() - $last_attempt) >= 300) {
        Session::put('login_attempts', 0);
        $login_attempts = 0;
    }
    
    $email = AuthHelper::sanitize_input($_POST['email']);
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) {
        $message = "<div class='alert alert-danger text-center mt-3'>❌ Please fill in all fields</div>";
    } elseif (!AuthHelper::validate_email($email)) {
        $message = "<div class='alert alert-danger text-center mt-3'>❌ Please enter a valid email address</div>";
    } else {
        $user = AuthHelper::authenticate_user($email, $password);
        
        if ($user) {
            Session::forget(['login_attempts', 'last_attempt']);
            
            // Login using Laravel Auth
            Auth::loginUsingId($user->id);
            Session::put('user', $user->toArray());
            Session::put('login_time', time());
            
            header("Location: ../dashboard/index.php");
            exit;
        } else {
            Session::put('login_attempts', $login_attempts + 1);
            Session::put('last_attempt', time());
            $message = "<div class='alert alert-danger text-center mt-3'>❌ Invalid email or password</div>";
        }
    }
}

if (isset($_GET['logout']) && $_GET['logout'] === 'success') {
    $message = "<div class='alert alert-success text-center mt-3'>✅ You have been logged out successfully</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login | FatoraBee</title>
  <link rel="icon" href="../images/logo.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="login.css" />
  <script src="https://kit.fontawesome.com/yourFontAwesomeKit.js" crossorigin="anonymous"></script>
  <style>
    body {
      background: linear-gradient(135deg, #fff9dc 0%, #ffe680 100%);
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
  </style>
</head>
<body>

<section class="login-section d-flex justify-content-center align-items-center">
  <div class="login-box p-4 shadow-lg bg-white rounded-4">
    <div class="text-center mb-4">
      <div class="brand-logo mb-3">
        <i class="fas fa-receipt fa-4x text-warning"></i>
      </div>
      <h3 class="mb-1"><span class="text-dark">Fatora</span><span class="text-warning">Bee</span></h3>
      <p class="text-muted small">Welcome back! Sign in to your dashboard</p>
    </div>

    <?php if(!empty($message)) echo $message; ?>

    <?php if ($login_attempts < 5 || (time() - $last_attempt) >= 300): ?>
    <form id="loginForm" method="POST" action="">
      <?php echo csrf_field(); ?>
      <div class="form-floating mb-3">
        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" 
               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required />
        <label for="email">Email address</label>
      </div>
      <div class="form-floating mb-3 position-relative">
        <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required />
        <label for="password">Password</label>
        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
      </div>
      <div class="form-check mb-3 text-start">
        <input class="form-check-input" type="checkbox" id="rememberMe"/>
        <label class="form-check-label" for="rememberMe">Remember me</label>
      </div>

      <button type="submit" class="btn btn-warning w-100 fw-bold">
        <i class="fas fa-sign-in-alt me-2"></i>Log in
      </button>

      <div id="loginSpinner" class="text-center mt-3" style="display: none;">
        <div class="spinner-border text-warning" role="status"></div>
        <p class="mt-2 text-muted">Redirecting to dashboard...</p>
      </div>
    </form>

    <div class="mt-3 text-center small text-muted">
      Don't have an account? 
      <a href="signup.php" class="text-warning fw-bold text-decoration-none">Create Account</a>
    </div>

    <div class="text-center my-3 text-muted">or sign in with</div>
    <div class="d-flex justify-content-between mb-3">
      <button type="button" class="btn btn-outline-danger w-100 me-2 google-btn">
        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg" alt="Google" class="icon"> Google
      </button>
      <button type="button" class="btn btn-outline-dark w-100 ms-2 github-btn">
        <i class="fab fa-github me-2"></i> GitHub
      </button>
    </div>

    <div class="text-center">
      <a href="forgot.php" class="text-decoration-none text-warning">Forgot password?</a>
    </div>
    <?php endif; ?>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById("togglePassword")?.addEventListener("click", function () {
  const passwordField = document.getElementById("password");
  const type = passwordField.type === "password" ? "text" : "password";
  passwordField.type = type;
  this.classList.toggle("fa-eye");
  this.classList.toggle("fa-eye-slash");
});

document.getElementById("loginForm").addEventListener("submit", function (e) {
  const submitBtn = this.querySelector('button[type="submit"]');
  const spinner = document.getElementById("loginSpinner");
  
  submitBtn.style.display = 'none';
  spinner.style.display = 'block';
  
  setTimeout(() => {
    // Form will submit naturally after this
  }, 1000);
});

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