
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FatoraBee</title>
    <link rel="icon" type="image/png" href="./img/WhatsApp Image 2025-07-21 at 02.56.39_8af938a4.jpg">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
    <img src="./img/WhatsApp Image 2025-07-21 at 02.56.39_8af938a4.jpg" alt="FatoraBee Logo" class="logo-image me-2" style="width: 70px; height: 70px; object-fit: contain;">
    <span class="brand-name">
        <span style="color: #000;">Fatora</span><span style="color: #f1c40f;">Bee</span>
    </span>
</a>

            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('products') }}">Products</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('whyus') }}">Why Us?</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('pos-features') }}">POS Features</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('pricing') }}">Pricing</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('how-it-works') }}">How It Works</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
    <li class="nav-item"><a class="btn btn-primary ms-2" href="{{ route('signup') }}">Sign up</a></li>

                    <li class="nav-item">
  <button id="toggleModeBtn" class="btn btn-outline-secondary ms-2">
    🌙 Dark Mode
  </button>
</li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
<section class="hero-section position-relative overflow-hidden">
    <!-- Honeycomb Background SVG -->
    <svg class="honeycomb-bg" viewBox="0 0 100 100" preserveAspectRatio="none">
        <defs>
            <pattern id="hex" width="10" height="10" patternUnits="userSpaceOnUse">
                <polygon points="5,0 10,2.5 10,7.5 5,10 0,7.5 0,2.5" fill="#fff8d6" />
            </pattern>
        </defs>
        <rect width="100%" height="100%" fill="url(#hex)" />
    </svg>

    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 text-start">
                <h1 class="display-4 fw-bold mb-4 text-dark">Make it easy for customers to pay you.</h1>
                <p class="lead mb-4 text-secondary">Free POS Software for Small Business.</p>
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg px-5 py-3 shadow">Get Started!</a>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-icon-wrapper">
                    <i class="fas fa-cash-register display-1 text-warning buzz-icon"></i>
                    <p class="text-muted mt-2">Fast. Simple. Powerful.</p>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Join Section -->
    <section class="join-section py-5 bg-white text-center">
        <div class="container">
            <h2 class="fw-bold mb-4">Join 200,000 Small Businesses</h2>
            <p class="lead mb-5">4 steps to get paid, fast!</p>
            
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-card h-100">
                        <div class="step-number">1</div>
                        <h5 class="fw-bold text-dark mb-3">STEP</h5>
                        <h6 class="mb-3">Let's get started!</h6>
                        <ul class="list-unstyled">
                            <li>Create a FREE account</li>
                            <li>Confirm your email</li>
                            <li>Login & customize!</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-card h-100">
                        <div class="step-number">2</div>
                        <h5 class="fw-bold text-dark mb-3">STEP</h5>
                        <h6 class="mb-3">Upload your logo</h6>
                        <ul class="list-unstyled">
                            <li>Upload your logo</li>
                            <li>Enter company info</li>
                            <li>Explore receipt designs</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-card h-100">
                        <div class="step-number">3</div>
                        <h5 class="fw-bold text-dark mb-3">STEP</h5>
                        <h6 class="mb-3">Setup online payments</h6>
                        <ul class="list-unstyled">
                            <li>Stripe Connect</li>
                            <li>PayPal & Venmo</li>
                            <li>Many payment options</li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="step-card h-100">
                        <div class="step-number">4</div>
                        <h5 class="fw-bold text-dark mb-3">STEP</h5>
                        <h6 class="mb-3">Create sales, get paid</h6>
                        <ul class="list-unstyled">
                            <li>Process sales & receipts</li>
                            <li>Track inventory & customers</li>
                            <li>Sync your bank accounts</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Balance & Status Dashboard -->
    <section class="dashboard-section py-5 bg-light">
        <div class="container">
            <div class="row">
                <!-- Left Side - Status -->
                <div class="col-lg-4 mb-4">
                    <div class="status-panel bg-white rounded shadow-sm p-4">
                        <h4 class="mb-4">System Status</h4>
                        <div class="status-items">
                            <div class="status-item d-flex align-items-center mb-3">
                                <div class="status-icon active me-3">
                                    <i class="fas fa-credit-card"></i>
                                </div>
                                <div class="status-info flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <span>Payments</span>
                                        <span class="badge bg-success">Active</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="status-item d-flex align-items-center mb-3">
                                <div class="status-icon active me-3">
                                    <i class="fas fa-receipt"></i>
                                </div>
                                <div class="status-info flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <span>POS Terminal</span>
                                        <span class="badge bg-success">Running</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="status-item d-flex align-items-center mb-3">
                                <div class="status-icon sync me-3">
                                    <i class="fas fa-sync-alt rotating"></i>
                                </div>
                                <div class="status-info flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <span>Sync</span>
                                        <span class="badge bg-warning">Syncing</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="status-item d-flex align-items-center mb-3">
                                <div class="status-icon active me-3">
                                    <i class="fas fa-database"></i>
                                </div>
                                <div class="status-info flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <span>Database</span>
                                        <span class="badge bg-success">Connected</span>
                                    </div>
                                </div>
                            </div>

                            <div class="status-item d-flex align-items-center">
                                <div class="status-icon active me-3">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="status-info flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <span>Inventory</span>
                                        <span class="badge bg-success">Updated</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Balance & Analytics -->
                <div class="col-lg-8">
                    <div class="balance-panel bg-white rounded shadow-sm p-4">
                        <h4 class="mb-4">Current Balance</h4>
                        
                        <!-- Main Balance Card -->
                        <div class="balance-card mb-4" id="balanceCard">
                            <div class="balance-amount text-center">
                                <div class="currency-symbol">$</div>
                                <div class="amount-display" id="balanceAmount">1,524.00</div>
                                <div class="balance-subtitle">Click to refresh balance</div>
                            </div>
                        </div>
                        
                        <!-- Sales Analytics -->
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="analytics-card">
                                    <div class="analytics-header">
                                        <i class="fas fa-calendar-day text-primary"></i>
                                        <span>Today's Sales</span>
                                    </div>
                                    <div class="analytics-amount">$280.50</div>
                                    <div class="analytics-change positive">
                                        <i class="fas fa-arrow-up"></i> +12.5%
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <div class="analytics-card">
                                    <div class="analytics-header">
                                        <i class="fas fa-calendar-week text-success"></i>
                                        <span>This Week</span>
                                    </div>
                                    <div class="analytics-amount">$1,842.30</div>
                                    <div class="analytics-change positive">
                                        <i class="fas fa-arrow-up"></i> +8.2%
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <div class="analytics-card">
                                    <div class="analytics-header">
                                        <i class="fas fa-calendar-alt text-warning"></i>
                                        <span>This Month</span>
                                    </div>
                                    <div class="analytics-amount">$7,256.80</div>
                                    <div class="analytics-change negative">
                                        <i class="fas fa-arrow-down"></i> -3.1%
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="quick-actions d-flex gap-2 mt-3">
                            <button class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-plus"></i> New Sale
                            </button>
                            <button class="btn btn-outline-success btn-sm">
                                <i class="fas fa-chart-bar"></i> View Reports
                            </button>
                            <button class="btn btn-outline-warning btn-sm">
                                <i class="fas fa-sync"></i> Sync Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Payments, apps, integrations</h2>
                <p class="lead">Everything you need to run your business smoothly</p>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-item text-center">
                        <div class="feature-icon">
                            <i class="fas fa-credit-card"></i>
                        </div>
                        <h5>Payment Gateways</h5>
                        <p>Accept credit cards, digital wallets, and more</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-item text-center">
                        <div class="feature-icon">
                            <i class="fas fa-mobile-alt"></i>
                        </div>
                        <h5>Mobile & Desktop Apps</h5>
                        <p>Run your POS from anywhere, anytime</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-item text-center">
                        <div class="feature-icon">
                            <i class="fas fa-puzzle-piece"></i>
                        </div>
                        <h5>Integrations</h5>
                        <p>Connect with your favorite business tools</p>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="feature-item text-center">
                        <div class="feature-icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <h5>Receipt Templates</h5>
                        <p>Professional receipts that match your brand</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Receipt Templates Section -->
<section class="templates-section py-5" style="background: linear-gradient(135deg, #fffbe6, #fff8cc);">
    <div class="container text-center">
        <h2 class="fw-bold mb-4 text-warning display-5">
            <i class="fas fa-receipt me-2"></i> The Perfect Receipt Design for Your Business
        </h2>
        <p class="lead mb-5 text-muted">Creating professional receipts is easier than ever.</p>

        <div class="row g-4 justify-content-center">
            <!-- Free Templates Card -->
            <div class="col-md-5 col-lg-4">
                <div class="template-card bg-white shadow-lg rounded-4 p-4 h-100 position-relative hover-float">
                    <div class="template-icon mb-3">
                        <i class="fas fa-gift fa-2x text-warning"></i>
                    </div>
                    <h5 class="fw-bold text-dark">4 Free Receipt Templates</h5>
                    <p class="text-muted small">Included in every Free account. Get started instantly!</p>
                    <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-3">Free</span>
                </div>
            </div>

            <!-- Pro Templates Card -->
            <div class="col-md-5 col-lg-4">
                <div class="template-card bg-white shadow-lg rounded-4 p-4 h-100 position-relative hover-float">
                    <div class="template-icon mb-3">
                        <i class="fas fa-crown fa-2x text-warning"></i>
                    </div>
                    <h5 class="fw-bold text-dark">11 Pro Templates</h5>
                    <p class="text-muted small">Unlock all designs with our Pro & Enterprise plans. 100% customizable!</p>
                    <span class="badge bg-dark text-warning position-absolute top-0 end-0 m-3">Pro</span>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <a href="./Pricing/pricing.html" class="btn btn-primary btn-lg px-5 py-3">
                <i class="fas fa-eye me-2"></i> View All Receipt Templates
            </a>
        </div>
    </div>
</section>

    <!-- Who's It For Section -->
<section class="audience-section py-5" style="background: linear-gradient(135deg, #fffdf2, #fff9e0);">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold display-6 text-warning">
        <i class="fas fa-question-circle me-2"></i> Who's it for?
      </h2>
      <p class="lead text-muted">Have customers to serve? FatoraBee is your solution to get paid – fast and easy!</p>
    </div>

    <div class="row g-4 justify-content-center">
      <!-- Retail Card -->
      <div class="col-md-6">
        <div class="audience-card bg-white shadow-lg rounded-4 p-4 h-100 text-center hover-float">
          <div class="audience-icon mb-3">
            <i class="fas fa-store fa-3x text-warning"></i>
          </div>
          <h4 class="fw-bold mb-3">Retail & Small Business POS</h4>
          <p class="text-muted">Sell in-store or online with smart receipts, inventory alerts, and flexible payment methods.</p>
          <a href="#" class="btn btn-outline-warning mt-3">Learn more</a>
        </div>
      </div>

      <!-- Team Card -->
      <div class="col-md-6">
        <div class="audience-card bg-white shadow-lg rounded-4 p-4 h-100 text-center hover-float">
          <div class="audience-icon mb-3">
            <i class="fas fa-users fa-3x text-warning"></i>
          </div>
          <h4 class="fw-bold mb-3">Multi-user POS for Teams</h4>
          <p class="text-muted">Give your staff their own login to track transactions, inventory, and more – all in real-time!</p>
          <p class="text-muted">Empower your team to work smarter and faster with every receipt they send.</p>
          <a href="#" class="btn btn-outline-warning mt-3">Learn more</a>
        </div>
      </div>
    </div>
  </div>
</section>


    <!-- Testimonials Section -->
<!-- Testimonials Section -->
<section class="testimonials-section py-5" style="background: linear-gradient(135deg, #fffbee, #fff9e7);">
  <div class="container text-center">
    <h2 class="fw-bold mb-5 text-warning">
      <i class="fas fa-star me-2"></i> 200,000+ businesses rely on FatoraBee
    </h2>

    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-lg-4">
        <div class="testimonial-card p-4 rounded-4 shadow-lg h-100 position-relative bg-white hover-float">
          <div class="stars text-warning mb-3">
            <i class="fas fa-star"></i> <i class="fas fa-star"></i> 
            <i class="fas fa-star"></i> <i class="fas fa-star"></i> 
            <i class="fas fa-star-half-alt"></i>
          </div>
          <blockquote class="blockquote mb-3">
            <p class="fst-italic">“FatoraBee is a robust, flexible, yet surprisingly affordable POS and sales management tool that more than 200,000 sole proprietors and small business owners use every day…”</p>
          </blockquote>
          <footer class="blockquote-footer text-muted">CardRates.com</footer>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-lg-4">
        <div class="testimonial-card p-4 rounded-4 shadow-lg h-100 position-relative bg-white hover-float">
          <div class="stars text-warning mb-3">
            <i class="fas fa-star"></i> <i class="fas fa-star"></i> 
            <i class="fas fa-star"></i> <i class="fas fa-star"></i> 
            <i class="fas fa-star"></i>
          </div>
          <blockquote class="blockquote mb-3">
            <p class="fst-italic">“FatoraBee is well on its way to becoming one of the greats of the POS world! A great option for small business owners!”</p>
          </blockquote>
          <footer class="blockquote-footer text-muted">Merchant Maverick</footer>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-lg-4">
        <div class="testimonial-card p-4 rounded-4 shadow-lg h-100 position-relative bg-white hover-float">
          <div class="stars text-warning mb-3">
            <i class="fas fa-star"></i> <i class="fas fa-star"></i> 
            <i class="fas fa-star"></i> <i class="fas fa-star"></i> 
            <i class="fas fa-star"></i>
          </div>
          <blockquote class="blockquote mb-3">
            <p class="fst-italic">“2023 Best for Entrepreneurs. The best free POS software is not only easy on the bank account but user-friendly and packed with features!”</p>
          </blockquote>
          <footer class="blockquote-footer text-muted">Forbes</footer>
        </div>
      </div>
    </div>
  </div>
</section>



   <!-- CTA Section -->
<section class="cta-section py-5 text-center text-white" style="background: linear-gradient(135deg, #f4b400, #fcd34d);">
    <div class="container">
        <h2 class="fw-bold mb-3">Start processing sales today!</h2>
        <p class="lead mb-4">Serve Customers, Get Paid Fast!</p>
        <a href="../dashboard/index.php" class="btn btn-light btn-lg px-5 py-3 fw-semibold shadow">🚀 Test Drive</a>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section py-5 bg-white">
    <div class="container">
        <h2 class="text-center fw-bold mb-5 text-warning"><i class="fas fa-question-circle me-2"></i>Frequently Asked Questions</h2>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="accordion accordion-flush" id="faqAccordion">
                    <!-- FAQ Item 1 -->
                    <div class="accordion-item border-warning mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                🐝 Why choose FatoraBee?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Our POS software is built for small to medium businesses who want to ditch the stress of complex systems and get straight to selling and earning — no finance degree required!
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="accordion-item border-warning mb-3">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                💸 What is free POS software?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                It’s your complete sales system — receipts, inventory, and transactions — all without the monthly drain on your wallet.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="accordion-item border-warning">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                💳 How do customers pay through the POS?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                From cash to card to tap-and-go — you name it. FatoraBee integrates all your payment methods in one sleek place.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer text-light py-5">
  <div class="container">
    <div class="row">
      <!-- Brand Column -->
      <div class="col-lg-3 mb-4">
        <div class="footer-brand">
          <div class="d-flex align-items-center mb-3">
            <div class="logo-placeholder me-2">
              <i class="fas fa-receipt fa-lg text-warning"></i>
            </div>
            <span class="brand-name">
              <span class="text-dark">Fatora</span><span class="text-warning">Bee</span>
            </span>
          </div>
          <p class="text-light">The leading POS and sales management solution for small businesses.</p>
        </div>
      </div>

      <!-- Products -->
      <div class="col-lg-2 col-md-6 mb-4">
        <h5 class="text-warning">Products</h5>
        <ul class="footer-links list-unstyled">
          <li><a href="#" class="text-light">Product Overview</a></li>
          <li><a href="#" class="text-light">POS, Sales, Payments</a></li>
          <li><a href="#" class="text-light">Inventory Management</a></li>
          <li><a href="#" class="text-light">Customer Management</a></li>
          <li><a href="#" class="text-light">Mobile Apps</a></li>
        </ul>
      </div>

      <!-- Why Us -->
      <div class="col-lg-2 col-md-6 mb-4">
        <h5 class="text-warning">Why FatoraBee?</h5>
        <ul class="footer-links list-unstyled">
          <li><a href="#" class="text-light">Referral Program</a></li>
          <li><a href="#" class="text-light">Our Story</a></li>
          <li><a href="#" class="text-light">Who's It For?</a></li>
          <li><a href="#" class="text-light">How It Works</a></li>
          <li><a href="#" class="text-light">How We Compare</a></li>
        </ul>
      </div>

      <!-- Resources -->
      <div class="col-lg-2 col-md-6 mb-4">
        <h5 class="text-warning">Resources</h5>
        <ul class="footer-links list-unstyled">
          <li><a href="#" class="text-light">Contact & Support</a></li>
          <li><a href="#" class="text-light">App User Guide</a></li>
          <li><a href="#" class="text-light">API Documentation</a></li>
          <li><a href="#" class="text-light">Business Blog</a></li>
          <li><a href="#" class="text-light">Server Status</a></li>
        </ul>
      </div>

      <!-- Pricing -->
      <div class="col-lg-2 col-md-6 mb-4">
        <h5 class="text-warning">Pricing</h5>
        <ul class="footer-links list-unstyled">
          <li><a href="#" class="text-light">Free Plan</a></li>
          <li><a href="#" class="text-light">Pro Plan</a></li>
          <li><a href="#" class="text-light">Enterprise Plan</a></li>
        </ul>
      </div>
    </div>

    <hr class="my-4">

    <!-- Bottom Footer -->
    <div class="row align-items-center">
      <div class="col-md-8">
        <p class="mb-0 text-light">&copy; FatoraBee</p>
        <div class="footer-legal-links mt-2">
          <a href="#" class="text-light me-3">Terms of Service</a>
          <a href="#" class="text-light me-3">Data Privacy</a>
          <a href="#" class="text-light me-3">PCI Compliance</a>
          <a href="#" class="text-light me-3">GDPR</a>
        </div>
      </div>
      <div class="col-md-4 text-end">
        <div class="social-links">
          <a href="#" class="text-light me-2"><i class="fab fa-facebook"></i></a>
          <a href="#" class="text-light me-2"><i class="fab fa-twitter"></i></a>
          <a href="#" class="text-light me-2"><i class="fab fa-linkedin"></i></a>
          <a href="#" class="text-light"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
  </div>
</footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('main.js') }}"></script>
</body>
</html>