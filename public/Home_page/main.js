// main.js

// Animate Balance Card on Click
document.getElementById("balanceCard")?.addEventListener("click", function () {
    const amountEl = document.getElementById("balanceAmount");
    amountEl.classList.add("animate__animated", "animate__tada");

    setTimeout(() => {
        const randomAmount = (Math.random() * 5000 + 1000).toFixed(2);
        amountEl.textContent = randomAmount;
        amountEl.classList.remove("animate__animated", "animate__tada");
    }, 1000);
});

// Scroll Reveal Animations
window.addEventListener("scroll", () => {
    document.querySelectorAll(".hover-float").forEach(el => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight - 100) {
            el.classList.add("animated-in");
        }
    });

    // Gradient background scroll effect
    const scrollY = window.scrollY;
    const hue = (scrollY / 5) % 360;
    document.body.style.background = `linear-gradient(180deg, hsl(${hue}, 100%, 97%), #fff)`;
});

// Buzz Hover Effect on Bee Text
const beeSpan = document.querySelector(".brand-name span.text-warning");
beeSpan?.addEventListener("mouseover", () => {
    beeSpan.style.display = "inline-block";
    beeSpan.style.animation = "buzz 0.5s ease-in-out infinite";
});
beeSpan?.addEventListener("mouseout", () => {
    beeSpan.style.animation = "none";
});
beeSpan?.addEventListener("click", () => {
    beeSpan.style.animation = "buzz-hard 0.4s ease-in-out 2";
});

// Typing Effect on Hero Title
const heroTitle = document.querySelector(".hero-section h1");
if (heroTitle) {
    const text = heroTitle.textContent;
    heroTitle.textContent = "";
    let i = 0;
    const typingInterval = setInterval(() => {
        if (i < text.length) {
            heroTitle.textContent += text.charAt(i);
            i++;
        } else {
            clearInterval(typingInterval);
        }
    }, 50);
}

// Stars fly when hovering on "Get Started" button
const getStartedBtn = document.querySelector(".hero-section .btn");
getStartedBtn?.addEventListener("mouseenter", () => {
    for (let i = 0; i < 10; i++) {
        const star = document.createElement("div");
        star.innerHTML = "✨";
        star.classList.add("flying-star");
        star.style.left = `${Math.random() * 100}%`;
        star.style.animationDelay = `${Math.random() * 0.5}s`;
        getStartedBtn.appendChild(star);
        setTimeout(() => star.remove(), 1000);
    }
});

// Inject Styles
const style = document.createElement("style");
style.textContent = `
@keyframes buzz {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(3deg); }
    50% { transform: rotate(-3deg); }
    75% { transform: rotate(3deg); }
}

@keyframes buzz-hard {
    0%, 100% { transform: rotate(0deg) scale(1); }
    25% { transform: rotate(6deg) scale(1.05); }
    50% { transform: rotate(-6deg) scale(1.05); }
    75% { transform: rotate(6deg) scale(1.05); }
}

.animated-in {
    opacity: 1 !important;
    transform: translateY(0) scale(1) !important;
    transition: all 0.8s ease-out;
}

.hover-float {
    opacity: 0;
    transform: translateY(50px) scale(0.95);
    transition: all 0.5s ease-out;
}

.flying-star {
    position: absolute;
    font-size: 14px;
    top: -10px;
    animation: fly-up 1s ease-out forwards;
    pointer-events: none;
}

@keyframes fly-up {
    to {
        transform: translateY(-40px) scale(1.5);
        opacity: 0;
    }
}
`;
document.head.appendChild(style);
// Sticky Navbar Scroll Effect
window.addEventListener("scroll", () => {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 20) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});
// Shake logo on hover
const logoImg = document.querySelector('.logo-image');
if (logoImg) {
  logoImg.addEventListener('mouseenter', () => {
    logoImg.classList.add('shake-logo');
    // Play sound
    const sound = new Audio('./assets/sounds/hover.mp3');
    sound.play();
  });
  logoImg.addEventListener('mouseleave', () => {
    logoImg.classList.remove('shake-logo');
  });
}

// Scroll To Top Button
const scrollBtn = document.createElement("button");
scrollBtn.innerHTML = "↑";
scrollBtn.className = "scroll-top-btn";
document.body.appendChild(scrollBtn);

scrollBtn.addEventListener("click", () => {
  window.scrollTo({ top: 0, behavior: 'smooth' });
});

window.addEventListener("scroll", () => {
  if (window.scrollY > 300) {
    scrollBtn.classList.add("visible");
  } else {
    scrollBtn.classList.remove("visible");
  }
});

// Sign Up button flash on click
document.querySelectorAll(".btn-primary").forEach(btn => {
  btn.addEventListener("click", () => {
    btn.classList.add("btn-flash");
    setTimeout(() => {
      btn.classList.remove("btn-flash");
    }, 500);
  });
});
// Change "Sign up" text to "Let's go!" on hover
document.querySelectorAll('a[href="#signup"]').forEach(btn => {
    const originalText = btn.textContent;

    btn.addEventListener("mouseover", () => {
        btn.textContent = "Let's go!";
    });

    btn.addEventListener("mouseout", () => {
        btn.textContent = originalText;
    });
});
// Toggle Light/Dark Mode
const toggleBtn = document.getElementById("toggleModeBtn");

toggleBtn?.addEventListener("click", () => {
    document.body.classList.toggle("dark-mode");

    if (document.body.classList.contains("dark-mode")) {
        toggleBtn.textContent = "☀️ Light Mode";
    } else {
        toggleBtn.textContent = "🌙 Dark Mode";
    }
});
// Reveal Join Section Steps
window.addEventListener("scroll", () => {
  document.querySelectorAll(".step-card").forEach((el, i) => {
    const rect = el.getBoundingClientRect();
    if (rect.top < window.innerHeight - 50) {
      el.style.transitionDelay = `${i * 0.1}s`;
      el.classList.add("animated-in");
    }
  });
});
