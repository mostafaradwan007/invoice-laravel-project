// 🎯 Toast عند الضغط على "Learn More"
document.querySelectorAll(".learn-more").forEach(button => {
  button.addEventListener("click", () => {
    const toast = document.createElement("div");
    toast.className = "toast align-items-center text-bg-success border-0 show position-fixed bottom-0 end-0 m-4 animate__animated animate__fadeInUp";
    toast.style.zIndex = "1056";
    toast.setAttribute("role", "alert");
    toast.innerHTML = `
      <div class="d-flex">
        <div class="toast-body">✨ This feature is coming soon!</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" title="Close"></button>
      </div>
    `;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
  });
});

const hero = document.querySelector('.hero-section');
const colors = ['#fff9db', '#fffde7', '#fff176', '#fff59d'];
let index = 0;
setInterval(() => {
  hero.style.background = `linear-gradient(120deg, ${colors[index]}, ${colors[(index + 1) % colors.length]})`;
  index = (index + 1) % colors.length;
}, 5000);


const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animate__animated', 'animate__fadeInUp');
      observer.unobserve(entry.target); // مره واحده بس
    }
  });
}, {
  threshold: 0.2
});

document.querySelectorAll('.section').forEach(section => {
  observer.observe(section);
});

const startBtn = document.querySelector('.hover-glow');
startBtn?.addEventListener('click', () => {
  const target = document.querySelector('.section');
  target.scrollIntoView({ behavior: 'smooth' });
});
