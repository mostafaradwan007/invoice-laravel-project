// ========== Scroll Animation for Cards ==========
const cards = document.querySelectorAll('.feature-card');

window.addEventListener('scroll', () => {
  cards.forEach(card => {
    const cardTop = card.getBoundingClientRect().top;
    const windowHeight = window.innerHeight;

    if (cardTop < windowHeight - 100) {
      card.classList.add('animate__animated', 'animate__fadeInUp');
    }
  });
});

// ========== Glow Effect on Hover ==========
cards.forEach(card => {
  card.addEventListener('mouseenter', () => {
    card.style.boxShadow = '0 0 20px #ffc107';
  });

  card.addEventListener('mouseleave', () => {
    card.style.boxShadow = '';
  });
});

// ========== Navbar Animation ==========
const navbar = document.querySelector('.navbar');

window.addEventListener('load', () => {
  navbar.classList.add('animate__animated', 'animate__fadeInDown');
});

// ========== CTA Button Buzz + Toast + Sound ==========
const ctaBtn = document.querySelector('.cta-section .btn');

ctaBtn.addEventListener('click', () => {
  // Buzz Animation
  ctaBtn.classList.add('animate__animated', 'animate__tada');

  setTimeout(() => {
    ctaBtn.classList.remove('animate__animated', 'animate__tada');
  }, 1000);

  // Toast
  showToast("🎉 تم تفعيل تجربة POS بنجاح!");

  // Play buzz sound
  const buzzSound = new Audio('https://cdn.pixabay.com/download/audio/2022/03/15/audio_6018f5a65d.mp3?filename=bee-buzz-6097.mp3');
  buzzSound.play();
});

// ========== Toast Function ==========
function showToast(message) {
  const toast = document.createElement('div');
  toast.textContent = message;
  toast.style.position = 'fixed';
  toast.style.bottom = '30px';
  toast.style.right = '30px';
  toast.style.backgroundColor = '#ffc107';
  toast.style.color = '#212529';
  toast.style.padding = '15px 20px';
  toast.style.borderRadius = '8px';
  toast.style.boxShadow = '0 5px 15px rgba(0,0,0,0.2)';
  toast.style.fontWeight = 'bold';
  toast.style.zIndex = 9999;
  document.body.appendChild(toast);

  setTimeout(() => {
    toast.remove();
  }, 3000);
}
