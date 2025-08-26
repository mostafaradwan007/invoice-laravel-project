document.addEventListener("DOMContentLoaded", () => {
  console.log("✅ FatoraBee JS Loaded");

  // Animate cards when in view
  const cards = document.querySelectorAll(".step-card");
  const options = {
    threshold: 0.3
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("animate__fadeInUp");
      }
    });
  }, options);

  cards.forEach(card => observer.observe(card));
});
