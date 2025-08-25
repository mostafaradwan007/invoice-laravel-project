// Light/Dark Toggle
document.getElementById("modeToggle").addEventListener("click", function () {
  const body = document.body;
  body.classList.toggle("theme-dark");
  const isDark = body.classList.contains("theme-dark");
  this.innerHTML = isDark ? "☀️" : "🌙";
});

// Optional: Switch theme color
document.addEventListener("DOMContentLoaded", () => {
  if (localStorage.getItem("theme") === "dark") {
    document.body.classList.add("theme-dark");
  }
});
