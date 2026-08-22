<?php
/**
 * =========================================================================
 *  index.php — Single-file dynamic responsive site with a PHP contact form
 *  Author: Senior Full-Stack Dev (PHP + Web Fundamentals)
 * =========================================================================
 *  This file demonstrates:
 *   - Native PHP POST handling, sanitization & validation
 *   - Session-based flash messaging (Success / Error) shown conditionally
 *   - Dynamic content rendering (Services array via foreach, dynamic Year)
 *   - Semantic HTML5 + Mobile-first responsive CSS (Grid + Flexbox)
 *   - Vanilla JS mobile nav toggle
 * =========================================================================
 */

// -------------------------------------------------------------------------
// 1. SESSION START
//    Needed so we can store flash messages across the POST -> redirect ->
//    GET cycle (Post/Redirect/Get pattern avoids resubmission on refresh).
// -------------------------------------------------------------------------
session_start();

// -------------------------------------------------------------------------
// 2. HANDLE CONTACT FORM POST REQUEST
// -------------------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {

    // --- 2a. Sanitize raw input -----------------------------------------
    // trim() removes stray whitespace; htmlspecialchars() neutralizes any
    // HTML/JS a user might try to inject (basic XSS protection on output).
    $name    = isset($_POST['name'])    ? trim($_POST['name'])    : '';
    $email   = isset($_POST['email'])   ? trim($_POST['email'])   : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    $name    = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    // filter_var below both sanitizes AND validates the email format.
    $email   = filter_var($email, FILTER_SANITIZE_EMAIL);

    // --- 2b. Validate ------------------------------------------------------
    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";
    } elseif (strlen($name) < 2) {
        $errors[] = "Name must be at least 2 characters long.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (empty($message)) {
        $errors[] = "Message cannot be empty.";
    } elseif (strlen($message) < 10) {
        $errors[] = "Message must be at least 10 characters long.";
    }

    // --- 2c. Store dynamic feedback in the session (flash messages) -----
    if (empty($errors)) {
        // In a real app you'd send an email / save to DB here.
        // e.g. mail($to, $subject, $message, $headers);
        $_SESSION['form_status']  = 'success';
        $_SESSION['form_message'] = "Thanks, {$name}! Your message has been received. We'll get back to you at {$email} soon.";
    } else {
        $_SESSION['form_status']  = 'error';
        $_SESSION['form_errors']  = $errors;
        // Preserve submitted values so the user doesn't have to retype them
        $_SESSION['form_values']  = [
            'name'    => $name,
            'email'   => $email,
            'message' => $message,
        ];
    }

    // --- 2d. Redirect (Post/Redirect/Get) to avoid resubmission ---------
    header("Location: " . $_SERVER['PHP_SELF'] . "#contact");
    exit;
}

// -------------------------------------------------------------------------
// 3. PULL FLASH MESSAGE DATA OUT OF THE SESSION (then clear it)
// -------------------------------------------------------------------------
$formStatus  = $_SESSION['form_status']  ?? null;
$formMessage = $_SESSION['form_message'] ?? null;
$formErrors  = $_SESSION['form_errors']  ?? [];
$formValues  = $_SESSION['form_values']  ?? ['name' => '', 'email' => '', 'message' => ''];

// Clear flash data so it only shows once (on next refresh it's gone)
unset($_SESSION['form_status'], $_SESSION['form_message'], $_SESSION['form_errors'], $_SESSION['form_values']);

// -------------------------------------------------------------------------
// 4. DYNAMIC PHP CONTENT — Services array rendered via foreach loop
// -------------------------------------------------------------------------
$services = [
    [
        'icon'  => '🚀',
        'title' => 'Web Development',
        'desc'  => 'Fast, scalable, and modern websites built with clean, maintainable code.',
    ],
    [
        'icon'  => '🎨',
        'title' => 'UI/UX Design',
        'desc'  => 'Intuitive interfaces and delightful user experiences across all devices.',
    ],
    [
        'icon'  => '⚙️',
        'title' => 'Backend & APIs',
        'desc'  => 'Robust server-side logic, databases, and RESTful API integrations.',
    ],
    [
        'icon'  => '📱',
        'title' => 'Responsive Design',
        'desc'  => 'Pixel-perfect layouts that adapt seamlessly from mobile to desktop.',
    ],
    [
        'icon'  => '🔒',
        'title' => 'Security & Hardening',
        'desc'  => 'Input validation, sanitization, and best practices to keep apps safe.',
    ],
    [
        'icon'  => '📈',
        'title' => 'Performance Tuning',
        'desc'  => 'Optimized assets and queries for lightning-fast load times.',
    ],
];

// Dynamic current year for the footer (updates automatically every year)
$currentYear = date('Y');

// A tiny helper to avoid repeating htmlspecialchars() everywhere below
function e($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DevStudio — PHP Full-Stack Demo</title>

<style>
/* =====================================================================
   CSS RESET / BASE
   ===================================================================== */
* { margin: 0; padding: 0; box-sizing: border-box; }

:root {
  --color-primary: #4f46e5;
  --color-primary-dark: #3730a3;
  --color-accent: #06b6d4;
  --color-bg: #f8fafc;
  --color-surface: #ffffff;
  --color-text: #1e293b;
  --color-muted: #64748b;
  --color-success-bg: #dcfce7;
  --color-success-text: #166534;
  --color-error-bg: #fee2e2;
  --color-error-text: #991b1b;
  --radius: 10px;
  --shadow: 0 4px 14px rgba(0,0,0,0.08);
  --max-width: 1140px;
}

html { scroll-behavior: smooth; }

body {
  font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
  background: var(--color-bg);
  color: var(--color-text);
  line-height: 1.6;
}

img { max-width: 100%; display: block; }
a { text-decoration: none; color: inherit; }
ul { list-style: none; }

.container {
  width: 100%;
  max-width: var(--max-width);
  margin: 0 auto;
  padding: 0 1.25rem;
}

.section-title {
  font-size: 1.75rem;
  margin-bottom: 0.5rem;
  text-align: center;
}
.section-subtitle {
  color: var(--color-muted);
  text-align: center;
  margin-bottom: 2.5rem;
}

/* =====================================================================
   HEADER / NAV  (mobile-first: stacked, hamburger toggle)
   ===================================================================== */
header {
  background: var(--color-surface);
  box-shadow: var(--shadow);
  position: sticky;
  top: 0;
  z-index: 100;
}

.navbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1rem 1.25rem;
  max-width: var(--max-width);
  margin: 0 auto;
}

.logo {
  font-weight: 700;
  font-size: 1.3rem;
  color: var(--color-primary);
}

/* Hamburger button — visible on mobile only */
.nav-toggle {
  display: flex;
  flex-direction: column;
  gap: 5px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 6px;
}
.nav-toggle span {
  width: 25px;
  height: 3px;
  background: var(--color-text);
  border-radius: 2px;
  transition: transform 0.3s ease, opacity 0.3s ease;
}
/* Animate hamburger -> X when menu is open */
.nav-toggle.active span:nth-child(1) { transform: translateY(8px) rotate(45deg); }
.nav-toggle.active span:nth-child(2) { opacity: 0; }
.nav-toggle.active span:nth-child(3) { transform: translateY(-8px) rotate(-45deg); }

.nav-menu {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background: var(--color-surface);
  flex-direction: column;
  align-items: center;
  gap: 0;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.35s ease;
  box-shadow: var(--shadow);
}
.nav-menu.open {
  max-height: 300px; /* enough to reveal all links */
}
.nav-menu li { width: 100%; text-align: center; }
.nav-menu a {
  display: block;
  padding: 1rem;
  border-top: 1px solid #eee;
  font-weight: 500;
  transition: background 0.2s ease;
}
.nav-menu a:hover { background: var(--color-bg); color: var(--color-primary); }

/* =====================================================================
   HERO
   ===================================================================== */
.hero {
  background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
  color: #fff;
  padding: 3.5rem 1.25rem;
  text-align: center;
}
.hero h1 { font-size: 2rem; margin-bottom: 0.75rem; }
.hero p { font-size: 1.05rem; opacity: 0.95; max-width: 560px; margin: 0 auto 1.5rem; }
.btn {
  display: inline-block;
  background: #fff;
  color: var(--color-primary);
  font-weight: 600;
  padding: 0.8rem 1.6rem;
  border-radius: var(--radius);
  border: none;
  cursor: pointer;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.btn:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,0,0,0.2); }

/* =====================================================================
   SERVICES — CSS GRID (mobile-first: 1 column)
   ===================================================================== */
.services {
  padding: 3rem 0;
}
.services-grid {
  display: grid;
  grid-template-columns: 1fr; /* mobile: single column */
  gap: 1.5rem;
}
.service-card {
  background: var(--color-surface);
  border-radius: var(--radius);
  padding: 1.75rem;
  box-shadow: var(--shadow);
  text-align: center;
  transition: transform 0.25s ease;
}
.service-card:hover { transform: translateY(-6px); }
.service-icon { font-size: 2.25rem; margin-bottom: 0.75rem; }
.service-card h3 { margin-bottom: 0.5rem; font-size: 1.15rem; }
.service-card p { color: var(--color-muted); font-size: 0.95rem; }

/* =====================================================================
   CONTACT — Flexbox layout, mobile-first: stacked
   ===================================================================== */
.contact {
  padding: 3rem 0 4rem;
}
.contact-wrapper {
  display: flex;
  flex-direction: column;
  gap: 2rem;
  background: var(--color-surface);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  padding: 2rem;
}
.contact-info h3 { margin-bottom: 0.5rem; }
.contact-info p { color: var(--color-muted); margin-bottom: 0.4rem; }

form { display: flex; flex-direction: column; gap: 1rem; }
.form-group { display: flex; flex-direction: column; gap: 0.4rem; }
label { font-weight: 600; font-size: 0.9rem; }
input, textarea {
  padding: 0.75rem;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  font: inherit;
  width: 100%;
  transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
input:focus, textarea:focus {
  outline: none;
  border-color: var(--color-primary);
  box-shadow: 0 0 0 3px rgba(79,70,229,0.15);
}
textarea { resize: vertical; min-height: 120px; }

.submit-btn {
  background: var(--color-primary);
  color: #fff;
  padding: 0.85rem;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s ease;
}
.submit-btn:hover { background: var(--color-primary-dark); }

/* --- Flash message alert boxes (PHP-driven) --- */
.alert {
  padding: 1rem 1.25rem;
  border-radius: 8px;
  margin-bottom: 1.5rem;
  font-size: 0.95rem;
}
.alert-success { background: var(--color-success-bg); color: var(--color-success-text); border: 1px solid #86efac; }
.alert-error   { background: var(--color-error-bg);   color: var(--color-error-text);   border: 1px solid #fca5a5; }
.alert ul { list-style: disc; margin-left: 1.25rem; margin-top: 0.4rem; }

/* =====================================================================
   FOOTER
   ===================================================================== */
footer {
  background: #0f172a;
  color: #cbd5e1;
  text-align: center;
  padding: 1.75rem 1.25rem;
  font-size: 0.9rem;
}
footer a { color: var(--color-accent); }

/* =====================================================================
   RESPONSIVE BREAKPOINTS
   ===================================================================== */

/* --- Tablet & up (>= 768px): show inline nav, 2-col services --- */
@media (min-width: 768px) {
  .nav-toggle { display: none; }

  .nav-menu {
    position: static;
    flex-direction: row;
    max-height: none;
    overflow: visible;
    box-shadow: none;
    gap: 1.5rem;
  }
  .nav-menu li { width: auto; }
  .nav-menu a { border-top: none; padding: 0.4rem 0.2rem; }

  .services-grid {
    grid-template-columns: repeat(2, 1fr);
  }

  .contact-wrapper {
    flex-direction: row;
  }
  .contact-info { flex: 1; }
  form { flex: 1.4; }

  .hero h1 { font-size: 2.6rem; }
  .hero p { font-size: 1.15rem; }
}

/* --- Desktop (>= 1024px): 3-col services, wider hero text --- */
@media (min-width: 1024px) {
  .services-grid {
    grid-template-columns: repeat(3, 1fr);
  }
  .hero { padding: 5rem 1.25rem; }
  .hero h1 { font-size: 3.2rem; }
  .hero p { font-size: 1.25rem; max-width: 680px; }
}
</style>
</head>
<body>

<!-- =====================================================================
     HEADER + NAV
     ===================================================================== -->
<header>
  <div class="navbar">
    <a href="#" class="logo">DevStudio&lt;/&gt;</a>

    <!-- Hamburger button (mobile only) -->
    <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>

    <nav>
      <ul class="nav-menu" id="navMenu">
        <li><a href="#home">Home</a></li>
        <li><a href="#services">Services</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </nav>
  </div>
</header>

<main>

  <!-- ===================================================================
       HERO SECTION
       =================================================================== -->
  <section class="hero" id="home">
    <div class="container">
      <h1>We Build Fast, Reliable Web Experiences</h1>
      <p>Native PHP backend logic meets clean, responsive front-end design — no frameworks required.</p>
      <a href="#contact" class="btn">Get In Touch</a>
    </div>
  </section>

  <!-- ===================================================================
       SERVICES SECTION — dynamically rendered from PHP array (foreach)
       =================================================================== -->
  <section class="services" id="services">
    <div class="container">
      <h2 class="section-title">Our Services</h2>
      <p class="section-subtitle">Everything rendered dynamically from a PHP array below.</p>

      <div class="services-grid">
        <?php foreach ($services as $service): ?>
          <div class="service-card">
            <div class="service-icon"><?php echo e($service['icon']); ?></div>
            <h3><?php echo e($service['title']); ?></h3>
            <p><?php echo e($service['desc']); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- ===================================================================
       CONTACT SECTION — PHP-powered form with validation & flash messages
       =================================================================== -->
  <section class="contact" id="contact">
    <div class="container">
      <h2 class="section-title">Contact Us</h2>
      <p class="section-subtitle">Fill out the form and we'll get back to you.</p>

      <div class="contact-wrapper">
        <div class="contact-info">
          <h3>Let's talk</h3>
          <p>📍 123 Web Avenue, Server City</p>
          <p>📧 hello@devstudio.example</p>
          <p>📞 +1 (555) 123-4567</p>
        </div>

        <div style="flex:1.4;">
          <?php
          // ---------------------------------------------------------
          // Conditionally display SUCCESS or ERROR feedback (PHP-driven)
          // ---------------------------------------------------------
          if ($formStatus === 'success'): ?>
            <div class="alert alert-success">
              ✅ <?php echo e($formMessage); ?>
            </div>
          <?php elseif ($formStatus === 'error'): ?>
            <div class="alert alert-error">
              ⚠️ Please fix the following:
              <ul>
                <?php foreach ($formErrors as $err): ?>
                  <li><?php echo e($err); ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <form action="<?php echo e($_SERVER['PHP_SELF']); ?>#contact" method="POST" novalidate>
            <div class="form-group">
              <label for="name">Full Name</label>
              <input type="text" id="name" name="name" placeholder="John Doe"
                     value="<?php echo e($formValues['name']); ?>" required>
            </div>

            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" id="email" name="email" placeholder="john@example.com"
                     value="<?php echo e($formValues['email']); ?>" required>
            </div>

            <div class="form-group">
              <label for="message">Message</label>
              <textarea id="message" name="message" placeholder="How can we help you?"
                        required><?php echo e($formValues['message']); ?></textarea>
            </div>

            <!-- Hidden flag lets PHP know this specific form was submitted -->
            <input type="hidden" name="contact_submit" value="1">
            <button type="submit" class="submit-btn">Send Message</button>
          </form>
        </div>
      </div>
    </div>
  </section>

</main>

<!-- =====================================================================
     FOOTER — dynamic current year via PHP date()
     ===================================================================== -->
<footer>
  <p>&copy; <?php echo e($currentYear); ?> DevStudio. All rights reserved. Built with native PHP.</p>
</footer>

<!-- =====================================================================
     VANILLA JAVASCRIPT — mobile nav toggle
     ===================================================================== -->
<script>
  // Grab the hamburger button and the nav menu list
  const navToggle = document.getElementById('navToggle');
  const navMenu   = document.getElementById('navMenu');

  navToggle.addEventListener('click', function () {
    // Toggle the 'open' class on the menu (controls max-height/visibility)
    navMenu.classList.toggle('open');
    // Toggle the 'active' class on the button (animates hamburger -> X)
    navToggle.classList.toggle('active');

    // Keep aria-expanded in sync for accessibility
    const isOpen = navMenu.classList.contains('open');
    navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
  });

  // Close the mobile menu automatically after a nav link is clicked
  document.querySelectorAll('.nav-menu a').forEach(function (link) {
    link.addEventListener('click', function () {
      navMenu.classList.remove('open');
      navToggle.classList.remove('active');
      navToggle.setAttribute('aria-expanded', 'false');
    });
  });
</script>

</body>
</html>
