// Initialize AOS (Animate On Scroll)
AOS.init({
    duration: 800,
    easing: 'ease-out-cubic',
    once: true,
    offset: 50
});

// Pricing data for monthly and annual plans
const pricingData = {
    monthly: {
        free: {
            price: '$0',
            period: 'Per month',
            features: []
        },
        pro: {
            price: '$12',
            period: 'Per month',
            features: []
        },
        enterprise: {
            price: '$16',
            period: 'Per month',
            features: []
        }
    },
    annual: {
        free: {
            price: '$0',
            period: 'Per year',
            features: []
        },
        pro: {
            price: '$10',
            period: 'Per month with an annual plan!',
            features: [
                '<li class="annual-bonus"><i class="fas fa-star text-warning"></i> Auto Sales Tax Calculation (US States)</li>',
                '<li class="annual-bonus"><i class="fas fa-star text-warning"></i> Email Invoices via your custom SMTP</li>'
            ]
        },
        enterprise: {
            price: '$160',
            period: 'Per year',
            features: []
        }
    }
};

// DOM Elements
const pricingToggle = document.getElementById('pricingToggle');
const monthlyLabels = document.querySelectorAll('.monthly-label');
const annualLabels = document.querySelectorAll('.annual-label');
const saveBadge = document.querySelector('.save-badge');
const pricingCards = document.getElementById('pricingCards');

// Toggle Switch Animation
let isAnnual = false;

// Initialize pricing toggle
function initializePricingToggle() {
    pricingToggle.addEventListener('change', function() {
        isAnnual = this.checked;
        togglePricing();
        animateToggle();
    });
}

// Animate toggle switch
function animateToggle() {
    const toggleSwitch = document.querySelector('.toggle-switch');
    
    if (isAnnual) {
        toggleSwitch.classList.add('annual-active');
        saveBadge.style.opacity = '1';
        saveBadge.style.transform = 'translateX(0) scale(1)';
        
        // Animate labels
        monthlyLabels.forEach(label => {
            label.classList.remove('active');
        });
        annualLabels.forEach(label => {
            label.classList.add('active');
        });
    } else {
        toggleSwitch.classList.remove('annual-active');
        saveBadge.style.opacity = '0';
        saveBadge.style.transform = 'translateX(-10px) scale(0.9)';
        
        // Animate labels
        annualLabels.forEach(label => {
            label.classList.remove('active');
        });
        monthlyLabels.forEach(label => {
            label.classList.add('active');
        });
    }
}

// Toggle pricing display
function togglePricing() {
    const cards = document.querySelectorAll('.pricing-card');
    
    cards.forEach((card, index) => {
        // Add transition effect
        card.style.transform = 'translateY(10px)';
        card.style.opacity = '0.8';
        
        setTimeout(() => {
            updateCardPricing(card, index);
            
            // Animate back
            card.style.transform = 'translateY(0)';
            card.style.opacity = '1';
        }, 150);
    });
}

// Update individual card pricing
function updateCardPricing(card, cardIndex) {
    const planNames = ['free', 'pro', 'enterprise', 'premium'];
    const planName = planNames[cardIndex];
    
    if (planName === 'premium') return; // Premium plan doesn't change
    
    const priceElement = card.querySelector('.price');
    const periodElement = card.querySelector('.period');
    const monthlyPrice = card.querySelector('.monthly-price');
    const annualPrice = card.querySelector('.annual-price');
    const monthlyPeriod = card.querySelector('.monthly-period');
    const annualPeriod = card.querySelector('.annual-period');
    
    if (isAnnual) {
        // Show annual pricing
        if (monthlyPrice && annualPrice) {
            monthlyPrice.style.display = 'none';
            annualPrice.style.display = 'inline';
        }
        if (monthlyPeriod && annualPeriod) {
            monthlyPeriod.style.display = 'none';
            annualPeriod.style.display = 'inline';
        }
        
        // Add annual-only features for Pro plan
        if (planName === 'pro') {
            addAnnualFeatures(card);
        }
        
        // Update free plan period
        if (planName === 'free' && periodElement) {
            periodElement.textContent = 'Per year';
        }
    } else {
        // Show monthly pricing
        if (monthlyPrice && annualPrice) {
            monthlyPrice.style.display = 'inline';
            annualPrice.style.display = 'none';
        }
        if (monthlyPeriod && annualPeriod) {
            monthlyPeriod.style.display = 'inline';
            annualPeriod.style.display = 'none';
        }
        
        // Remove annual-only features
        removeAnnualFeatures(card);
        
        // Update free plan period
        if (planName === 'free' && periodElement) {
            periodElement.textContent = 'Per month';
        }
    }
}

// Add annual bonus features
function addAnnualFeatures(card) {
    const featuresList = card.querySelector('.features-list');
    const existingAnnualFeatures = featuresList.querySelectorAll('.annual-only');
    
    // Remove existing annual features first
    existingAnnualFeatures.forEach(feature => feature.remove());
    
    // Add new annual features with animation
    const annualFeatures = [
        '<li class="annual-only" style="opacity: 0; transform: translateX(-20px);"><i class="fas fa-star text-warning"></i> Auto Sales Tax Calculation (US States)</li>',
        '<li class="annual-only" style="opacity: 0; transform: translateX(-20px);"><i class="fas fa-star text-warning"></i> Email Invoices via your custom SMTP</li>'
    ];
    
    annualFeatures.forEach((featureHTML, index) => {
        featuresList.insertAdjacentHTML('beforeend', featureHTML);
        const newFeature = featuresList.lastElementChild;
        
        setTimeout(() => {
            newFeature.style.opacity = '1';
            newFeature.style.transform = 'translateX(0)';
            newFeature.style.transition = 'all 0.3s ease';
        }, index * 100);
    });
}

// Remove annual features
function removeAnnualFeatures(card) {
    const annualFeatures = card.querySelectorAll('.annual-only');
    annualFeatures.forEach((feature, index) => {
        setTimeout(() => {
            feature.style.opacity = '0';
            feature.style.transform = 'translateX(-20px)';
            setTimeout(() => feature.remove(), 200);
        }, index * 50);
    });
}

// Smooth scroll for anchor links
function initializeSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Enhanced accordion functionality
function initializeAccordion() {
    const accordionButtons = document.querySelectorAll('.accordion-button');
    
    accordionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const target = document.querySelector(this.getAttribute('data-bs-target'));
            const icon = this.querySelector('i') || this;
            
            // Add loading animation
            this.classList.add('loading');
            
            setTimeout(() => {
                this.classList.remove('loading');
                
                // Animate icon rotation
                if (this.classList.contains('collapsed')) {
                    icon.style.transform = 'rotate(0deg)';
                } else {
                    icon.style.transform = 'rotate(180deg)';
                }
            }, 100);
        });
    });
}

// Feature comparison table animations
function initializeFeatureComparison() {
    const comparisonToggle = document.querySelector('.comparison-toggle');
    const comparisonTable = document.getElementById('featureComparison');
    
    comparisonToggle.addEventListener('click', function() {
        const icon = this.querySelector('i');
        
        // Rotate arrow icon
        setTimeout(() => {
            if (comparisonTable.classList.contains('show')) {
                icon.style.transform = 'rotate(180deg)';
                animateTableRows();
            } else {
                icon.style.transform = 'rotate(0deg)';
            }
        }, 200);
    });
}

// Animate table rows when shown
function animateTableRows() {
    setTimeout(() => {
        const rows = document.querySelectorAll('.comparison-table tbody tr');
        rows.forEach((row, index) => {
            row.style.opacity = '0';
            row.style.transform = 'translateY(20px)';
            
            setTimeout(() => {
                row.style.transition = 'all 0.3s ease';
                row.style.opacity = '1';
                row.style.transform = 'translateY(0)';
            }, index * 50);
        });
    }, 300);
}

// Card hover effects
function initializeCardHoverEffects() {
    const pricingCards = document.querySelectorAll('.pricing-card');
    
    pricingCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
            this.style.boxShadow = '0 20px 40px rgba(0,0,0,0.1)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '0 10px 30px rgba(0,0,0,0.05)';
        });
    });
}

// Button click animations
function initializeButtonAnimations() {
    const buttons = document.querySelectorAll('.btn');
    
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Create ripple effect
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: rgba(255,255,255,0.3);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
            `;
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
}

// Add ripple animation CSS
function addRippleAnimation() {
    const style = document.createElement('style');
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
        
        .loading {
            position: relative;
            pointer-events: none;
        }
        
        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #007bff;
            border-top: 2px solid transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .annual-only {
            background: linear-gradient(90deg, #fff3cd, #ffffff);
            border-left: 3px solid #ffc107;
            padding-left: 10px;
            margin-left: -10px;
            border-radius: 4px;
        }
        
        .toggle-switch {
            transition: all 0.3s ease;
        }
        
        .toggle-switch.annual-active {
            background: linear-gradient(135deg, #28a745, #20c997);
        }
        
        .save-badge {
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        .pricing-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .comparison-toggle i {
            transition: transform 0.3s ease;
        }
        
        .accordion-button {
            transition: all 0.2s ease;
        }
    `;
    document.head.appendChild(style);
}

// Scroll animations
function initializeScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);
    
    // Observe pricing cards
    document.querySelectorAll('.pricing-card').forEach(card => {
        observer.observe(card);
    });
    
    // Observe FAQ items
    document.querySelectorAll('.accordion-item').forEach(item => {
        observer.observe(item);
    });
}

// Keyboard navigation
function initializeKeyboardNavigation() {
    document.addEventListener('keydown', function(e) {
        // Toggle pricing with 'T' key
        if (e.key === 't' || e.key === 'T') {
            e.preventDefault();
            pricingToggle.checked = !pricingToggle.checked;
            pricingToggle.dispatchEvent(new Event('change'));
        }
        
        // Open first FAQ with 'F' key
        if (e.key === 'f' || e.key === 'F') {
            e.preventDefault();
            const firstFAQ = document.querySelector('#faq1');
            if (firstFAQ && !firstFAQ.classList.contains('show')) {
                document.querySelector('[data-bs-target="#faq1"]').click();
            }
        }
    });
}

// Performance optimization - Lazy load animations
function initializeLazyAnimations() {
    const animateElements = document.querySelectorAll('[data-aos]');
    
    const animationObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('aos-animate');
                animationObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    
    animateElements.forEach(el => {
        animationObserver.observe(el);
    });
}

// Error handling for failed animations
function handleAnimationErrors() {
    window.addEventListener('error', function(e) {
        console.warn('Animation error handled:', e.message);
    });
}

// Initialize everything when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    try {
        // Add custom styles
        addRippleAnimation();
        
        // Initialize all functionality
        initializePricingToggle();
        initializeSmoothScroll();
        initializeAccordion();
        initializeFeatureComparison();
        initializeCardHoverEffects();
        initializeButtonAnimations();
        initializeScrollAnimations();
        initializeKeyboardNavigation();
        initializeLazyAnimations();
        handleAnimationErrors();
        
        // Add welcome animation
        setTimeout(() => {
            document.body.style.opacity = '1';
            document.body.style.transform = 'translateY(0)';
        }, 100);
        
        console.log('Pricing page initialized successfully! 🚀');
        
    } catch (error) {
        console.error('Error initializing pricing page:', error);
    }
});

// Window resize handler
window.addEventListener('resize', function() {
    // Recalculate AOS on resize
    AOS.refresh();
});

// Export functions for external use
window.PricingPage = {
    togglePricing,
    animateToggle,
    initializePricingToggle
};