<?php

require_once '../../vendor/autoload.php';

$app = require_once '../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$request = Illuminate\Http\Request::capture();
$response = $kernel->handle($request);

use App\Helpers\AuthHelper;
use Illuminate\Support\Facades\Auth;

AuthHelper::start_secure_session();

$message = "";
$message_type = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $username = AuthHelper::sanitize_input($_POST['username']);
    $email = AuthHelper::sanitize_input($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];
    
    $errors = array();
    
    if (empty($username) || strlen($username) < 2) {
        $errors[] = "Username must be at least 2 characters long";
    }
    
    if (!AuthHelper::validate_email($email)) {
        $errors[] = "Please enter a valid email address";
    }
    
    $password_check = AuthHelper::validate_password($password);
    if ($password_check !== true) {
        $errors[] = $password_check;
    }
    
    if ($password !== $confirm) {
        $errors[] = "Passwords do not match";
    }
    
    $profile_image = null;
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $uploadedFile = new \Illuminate\Http\UploadedFile(
            $_FILES['profile_image']['tmp_name'],
            $_FILES['profile_image']['name'],
            $_FILES['profile_image']['type'],
            $_FILES['profile_image']['error'],
            true
        );
        
        $profile_image = AuthHelper::handle_file_upload($uploadedFile);
        if ($profile_image === null && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $errors[] = "Invalid image file. Please upload JPG, PNG, or GIF (max 5MB)";
        }
    }
    
    if (empty($errors)) {
        $result = AuthHelper::register_user($username, $email, $password, $profile_image);
        
        if ($result['success']) {
            $user = AuthHelper::authenticate_user($email, $password);
            if ($user) {
                Auth::loginUsingId($user->id);
                session(['user' => $user->toArray(), 'login_time' => time()]);
                
                $message = "<div class='alert alert-success text-center mt-3'>🎉 Account created successfully! Redirecting to dashboard...</div>";
                $message_type = "success";
                
                echo "<script>
                    setTimeout(function() {
                        window.location.href = '../dashboard/index.php';
                    }, 2000);
                </script>";
            } else {
                $message = "<div class='alert alert-success text-center mt-3'>✅ " . $result['message'] . " Please login now.</div>";
                $message_type = "success";
            }
        } else {
            $message = "<div class='alert alert-danger text-center mt-3'>❌ " . $result['message'] . "</div>";
            $message_type = "error";
        }
    } else {
        $message = "<div class='alert alert-danger text-center mt-3'>❌ " . implode("<br>", $errors) . "</div>";
        $message_type = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up | FatoraBee</title>
  <link rel="icon" href="../images/logo.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="login.css" />
  <script src="https://kit.fontawesome.com/yourFontAwesomeKit.js" crossorigin="anonymous"></script>
  <style>
    /* تحسينات إضافية للتصميم */
    body {
      background: linear-gradient(135deg, #fff9dc 0%, #ffe680 100%);
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
  </style>
</head>
<body class="theme-light">

<section class="signup-section d-flex justify-content-center align-items-center">
  <div class="signup-box p-5 rounded-4 glassy">
    <div class="text-center mb-4">
      <i class="fas fa-receipt brand-icon"></i>
      <h3 class="fw-bold mt-2"><span class="text-dark">Fatora</span><span class="text-warning">Bee</span></h3>
      <p class="text-muted">Create your account and start managing invoices!</p>
    </div>

    {{-- عرض رسائل النجاح --}}
    @if(session('success'))
      <div class="alert alert-success text-center mt-3">{{ session('success') }}</div>
    @endif

    {{-- عرض الأخطاء --}}
    @if ($errors->any())
      <div class="alert alert-danger text-center mt-3">
        @foreach ($errors->all() as $error)
          {{ $error }} <br>
        @endforeach
      </div>
    @endif

    <form id="signupForm" method="POST" action="{{ route('signup.post') }}" enctype="multipart/form-data">
      @csrf
      <div class="form-floating mb-3">
        <input type="text" name="name" id="name" class="form-control" placeholder="Full Name" value="{{ old('name') }}" required>
        <label for="name"><i class="fas fa-user me-2"></i>Full Name</label>
      </div>
      
      <div class="form-floating mb-3">
        <input type="email" name="email" id="email" class="form-control" placeholder="name@example.com" value="{{ old('email') }}" required>
        <label for="email"><i class="fas fa-envelope me-2"></i>Email address</label>
      </div>
      
      <div class="form-floating mb-3">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
      </div>
      
      <div class="form-floating mb-3">
        <input type="password" name="password_confirmation" id="confirm_password" class="form-control" placeholder="Confirm Password" required>
        <label for="confirm_password"><i class="fas fa-lock me-2"></i>Confirm Password</label>
      </div>
      
      <div class="mb-3">
        <label class="form-label"><i class="fas fa-image me-2"></i>Profile Image (optional)</label>
        <input type="file" name="profile_image" class="form-control" accept="image/jpeg,image/jpg,image/png,image/gif">
      </div>
      
      <button type="submit" class="btn btn-warning w-100 fw-bold py-2 mb-3">
        <i class="fas fa-user-plus me-2"></i>Create Account
      </button>

      <div class="text-center">
        <p>Already have an account? <a href="{{ route('login') }}" class="text-warning fw-bold">Sign In</a></p>
      </div>
    </form>
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

// Enhanced form submission
document.getElementById("signupForm").addEventListener("submit", function (e) {
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
  
  if (password.length >= 6) {
    progressBar.classList.add('show');
    progressBar.style.background = 'linear-gradient(90deg, #10b981, #34d399)';
  } else if (password.length >= 3) {
    progressBar.classList.add('show');
    progressBar.style.background = 'linear-gradient(90deg, #f59e0b, #fbbf24)';
  } else {
    progressBar.classList.remove('show');
  }
});

// Auto-hide messages
document.addEventListener('DOMContentLoaded', function() {
  const alerts = document.querySelectorAll('.alert');
  alerts.forEach(alert => {
    if (alert.classList.contains('alert-success')) {
      // Success messages stay longer
      setTimeout(() => {
        alert.style.transition = 'opacity 0.5s ease-out';
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 500);
      }, 8000);
    } else {
      // Error messages disappear faster
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
</script>

<?php if ($message_type === "success"): ?>
<script>
// Show success animation and redirect
setTimeout(function() {
  const successMsg = document.querySelector('.alert-success');
  if (successMsg) {
    successMsg.innerHTML = '🚀 Welcome to FatoraBee! Redirecting to your dashboard...';
    successMsg.style.background = 'linear-gradient(135deg, #10b981, #34d399)';
  }
}, 1000);
</script>
<?php endif; ?>

</body>
</html>