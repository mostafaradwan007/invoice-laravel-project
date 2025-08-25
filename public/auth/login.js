// Toggle password visibility
document.getElementById("togglePassword").addEventListener("click", function () {
  const passwordField = document.getElementById("password");
  const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
  passwordField.setAttribute("type", type);
  this.classList.toggle("fa-eye");
  this.classList.toggle("fa-eye-slash");
});

// Show/Hide spinner
function showSpinner() {
  document.getElementById("loginSpinner").style.display = "block";
}
function hideSpinner() {
  document.getElementById("loginSpinner").style.display = "none";
}

// Toast function
function showToast(message, type = "success") {
  const toastEl = document.getElementById("loginToast");
  toastEl.className = `toast align-items-center text-bg-${type} border-0`;
  toastEl.querySelector(".toast-body").textContent = message;
  const toast = new bootstrap.Toast(toastEl);
  toast.show();
}

// Handle form submit
document.getElementById("loginForm").addEventListener("submit", function (e) {
  e.preventDefault();
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  if (email && password) {
    showSpinner();
    setTimeout(() => {
      hideSpinner();
      showToast("✅ Login successful! Welcome back!", "success");
      // window.location.href = "/dashboard.html";
    }, 1200);
  } else {
    showToast("❌ Please fill in all fields.", "danger");
  }
});
// Toggle password visibility
document.getElementById("togglePassword")?.addEventListener("click", function () {
  const passwordField = document.getElementById("password");
  const type = passwordField.type === "password" ? "text" : "password";
  passwordField.type = type;
  this.classList.toggle("fa-eye");
  this.classList.toggle("fa-eye-slash");
});

// Form submit with toast
document.getElementById("signupForm")?.addEventListener("submit", function (e) {
  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  if (name && email && password) {
    const toast = new bootstrap.Toast(document.getElementById("successToast"));
    toast.show();
  } else {
    alert("❌ Please fill all fields");
  }
});

// Toggle Theme Mode
document.getElementById("modeToggle")?.addEventListener("click", () => {
  document.body.classList.toggle("theme-dark");
  document.body.classList.toggle("theme-light");
  const icon = document.getElementById("modeToggle");
  icon.textContent = document.body.classList.contains("theme-dark") ? "☀️" : "🌙";
});
