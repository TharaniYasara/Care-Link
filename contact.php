<!DOCTYPE html>
<html lang="en">

<?php
require 'admin/db.php'; // Include your database connection

// Handle contact form submission
$contact_message = '';
$contact_message_type = '';
$form_data = []; // Initialize empty form data

if ($_POST && isset($_POST['action']) && $_POST['action'] === 'submit_contact') {
    try {
        $name = trim($_POST['contact_name']);
        $email = trim($_POST['contact_email']);
        $phone = trim($_POST['contact_phone']);
        $subject = trim($_POST['contact_subject']);
        $message = trim($_POST['contact_message']);

        // Store form data for repopulation in case of error
        $form_data = [
            'contact_name' => $name,
            'contact_email' => $email,
            'contact_phone' => $phone,
            'contact_subject' => $subject,
            'contact_message' => $message
        ];

        // Validate required fields
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {
            throw new Exception('Please fill in all required fields.');
        }

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Please enter a valid email address.');
        }

        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO contact_submissions (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
        $result = $stmt->execute([$name, $email, $phone, $subject, $message]);

        if ($result) {
            $contact_message = 'Thank you for your message! We will get back to you soon.';
            $contact_message_type = 'success';
            // Clear form data on successful submission
            $form_data = [];
        } else {
            throw new Exception('Failed to submit your message. Please try again.');
        }

    } catch (Exception $e) {
        $contact_message = $e->getMessage();
        $contact_message_type = 'error';
        // Keep form data for error case (already stored above)
    }
}
?>

<head>
    <title>Contact Us - CareLink</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="fonts/icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" type="text/css" href="style.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+SC:wght@400;700&family=Jost:wght@300;400;700&display=swap"
        rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="images/favicon.ico">
    <script src="js/modernizr.js"></script>

    <style>
    .contact-section {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .contact-form-container {
        background: white;
        padding: 50px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        margin: 0 auto;
    }

    .contact-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .contact-header h2 {
        color: #333;
        font-size: 2.5em;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .contact-header p {
        color: #666;
        font-size: 1.1em;
        line-height: 1.6;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
        font-size: 16px;
    }

    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid #e1e5e9;
        border-radius: 8px;
        font-size: 16px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        font-family: inherit;
        box-sizing: border-box;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 150px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .btn-submit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 15px 40px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    }

    .alert {
        padding: 20px;
        margin-bottom: 30px;
        border: 1px solid transparent;
        border-radius: 8px;
        font-size: 16px;
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-error {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    .contact-info {
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
    }

    .contact-info h3 {
        color: #333;
        margin-bottom: 20px;
        font-size: 1.8em;
    }

    .contact-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .contact-info-item i {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        font-size: 20px;
    }

    .contact-info-item .contact-icon {
        background: linear-gradient(135deg, #7EEA66FF 0%, #51A24BFF 100%);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        font-size: 18px;
        font-style: normal;
    }

    .contact-info-item div {
        flex: 1;
    }

    .contact-info-item strong {
        display: block;
        color: #333;
        font-size: 16px;
        margin-bottom: 5px;
    }

    .contact-info-item span {
        color: #666;
        font-size: 14px;
    }

    @media (max-width: 768px) {

        .contact-form-container,
        .contact-info {
            padding: 30px 20px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }

        .contact-header h2 {
            font-size: 2em;
        }
    }

    .page-banner {
        background: linear-gradient(135deg, #66EA66FF 0%, #4BA252FF 100%);
        padding: 60px 0;
        text-align: center;
        color: white;
    }

    .page-banner h1 {
        font-size: 3em;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .page-banner p {
        font-size: 1.2em;
        opacity: 0.9;
    }
    </style>
</head>

<body>
    <div id="header-wrap">
        <header id="header">
            <div class="container">
                <div class="inner-content">
                    <div class="grid">
                        <div class="main-logo">
                            <a href="index.php"><img src="images/main-logo.png" alt="logo"></a>
                        </div>

                        <nav id="navbar">
                            <div class="main-menu">
                                <ul class="menu-list">
                                    <li class="menu-item active"><a href="index.php" class="nav-link"
                                            data-effect="Home">Home</a></li>
                                    <li class="menu-item"><a href="index.php#about" class="nav-link"
                                            data-effect="About">About</a></li>
                                    <li class="menu-item"><a href="index.php#projects" class="nav-link"
                                            data-effect="Events">Events</a></li>
                                    <li class="menu-item"><a href="index.php#testimonial" class="nav-link"
                                            data-effect="Donations">Donations</a></li>
                                    <li class="menu-item"><a href="index.php#services" class="nav-link"
                                            data-effect="Adoption">Adoption</a></li>
                                    <li class="menu-item"><a href="#" class="nav-link" data-effect="Contact">Contact</a>
                                    </li>
                                    <li class="menu-item"><a href="blog.php" class="nav-link"
                                            data-effect="Blog">Blog</a></li>
                                    <li class="menu-item"><a href="account.html" class="nav-link"
                                            data-effect="Account">Account</a></li>
                                </ul>
                            </div>

                            <a href="./" class="btn-hvr-effect">
                                <span>Home</span>
                            </a>
                        </nav>

                        <nav id="new-navbar">
                            <div class="new-main-menu">
                                <!-- Mobile Menu Toggle -->
                                <div class="new-hamburger" id="new-hamburger">
                                    <span class="new-bar"></span>
                                    <span class="new-bar"></span>
                                    <span class="new-bar"></span>
                                </div>

                                <!-- Expanded Menu -->
                                <ul class="new-menu-list" id="new-menu-list">
                                    <li class="menu-item active"><a href="index.php" class="nav-link"
                                            data-effect="Home">Home</a></li>
                                    <li class="menu-item"><a href="index.php#about" class="nav-link"
                                            data-effect="About">About</a></li>
                                    <li class="menu-item"><a href="index.php#projects" class="nav-link"
                                            data-effect="Events">Events</a></li>
                                    <li class="menu-item"><a href="index.php#testimonial" class="nav-link"
                                            data-effect="Donations">Donations</a></li>
                                    <li class="menu-item"><a href="index.php#services" class="nav-link"
                                            data-effect="Adoption">Adoption</a></li>
                                    <li class="menu-item"><a href="#" class="nav-link" data-effect="Contact">Contact</a>
                                    </li>
                                    <li class="menu-item"><a href="blog.php" class="nav-link"
                                            data-effect="Blog">Blog</a></li>
                                    <li class="menu-item"><a href="account.html" class="nav-link"
                                            data-effect="Account">Account</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
    </div>

    <!-- Page Banner -->
    <section class="page-banner">
        <div class="container">
            <h1 style="color: #ffffff;">Contact Us</h1>
            <p>We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="row">
                <div class="inner-content">

                    <!-- Contact Information -->
                    <div class="contact-info">
                        <h3>Get in Touch</h3>
                        <div class="grid"
                            style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                            <div class="contact-info-item">
                                <i class="contact-icon">📍</i>
                                <div>
                                    <strong>Our Location</strong>
                                    <span>No. 14, 3rd Lane, Nugegoda, Sri Lanka</span>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <i class="contact-icon">📞</i>
                                <div>
                                    <strong>Call Us</strong>
                                    <span>(+94) 11 234 5678</span>
                                </div>
                            </div>
                            <div class="contact-info-item">
                                <i class="contact-icon">✉️</i>
                                <div>
                                    <strong>Email Us</strong>
                                    <span>support@carelink.com</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="contact-form-container">
                        <div class="contact-header">
                            <h2>Send us a Message</h2>
                            <p>Fill out the form below and we'll get back to you as soon as possible.</p>
                        </div>

                        <?php if (!empty($contact_message)): ?>
                        <div class="alert alert-<?= $contact_message_type ?>">
                            <?= htmlspecialchars($contact_message) ?>
                        </div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <input type="hidden" name="action" value="submit_contact">

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="contact_name">Full Name *</label>
                                    <input type="text" id="contact_name" name="contact_name" required
                                        value="<?= htmlspecialchars($form_data['contact_name'] ?? '') ?>">
                                </div>

                                <div class="form-group">
                                    <label for="contact_email">Email Address *</label>
                                    <input type="email" id="contact_email" name="contact_email" required
                                        value="<?= htmlspecialchars($form_data['contact_email'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="contact_phone">Phone Number</label>
                                    <input type="tel" id="contact_phone" name="contact_phone"
                                        value="<?= htmlspecialchars($form_data['contact_phone'] ?? '') ?>">
                                </div>

                                <div class="form-group">
                                    <label for="contact_subject">Subject *</label>
                                    <input type="text" id="contact_subject" name="contact_subject" required
                                        value="<?= htmlspecialchars($form_data['contact_subject'] ?? '') ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="contact_message">Message *</label>
                                <textarea id="contact_message" name="contact_message" rows="6"
                                    required><?= htmlspecialchars($form_data['contact_message'] ?? '') ?></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn-submit">Send Message</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="inner-content">
                    <div class="footer-menu-list" data-aos="fade-up">
                        <div class="grid">

                            <div class="footer-menu">
                                <h3>Contact Us</h3>
                                <ul class="menu-list">
                                    <li class="menu-item">
                                        <strong>Our Location</strong>
                                        No. 14, 3rd Lane, Nugegoda, Sri Lanka
                                    </li>
                                    <li class="menu-item">
                                        <strong>Call Us</strong>
                                        (+94) 11 234 5678
                                    </li>
                                    <li class="menu-item">
                                        <strong>Send Us Mail</strong>
                                        <a href="mailto:support@carelink.com">support@carelink.com</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="footer-menu" style="padding-left: 30px;">
                                <h3>Useful Links</h3>
                                <ul class="menu-list">
                                    <li class="menu-item">
                                        <a href="index.php">Home</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="index.php#about">About</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="index.php#events">Events</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="donations.html">Donations</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="adoption.html">Adoption</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="footer-item">
                                <h2>Let's Talk</h2>
                                <p>Looking to volunteer, donate, or collaborate on child welfare projects? We'd love to
                                    hear from you. Let's work together to create a better future for every child.</p>
                                <div class="btn-wrap">
                                    <a href="contact.php" class="btn-accent">Contact us</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div id="footer-bottom">
        <div class="container">
            <div class="grid">
                <div class="copyright">
                    <p>© 2025 <a href="#">CareLink.</a> All rights reserved.</p>
                </div>

                <div class="social-links">
                    <ul>
                        <li>
                            <a href="#"><i class="icon icon-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="icon icon-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#"><i class="icon icon-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const newHamburger = document.getElementById("new-hamburger");
        const newMenuList = document.getElementById("new-menu-list");
        const newSubmenuToggles = document.querySelectorAll(".new-submenu-toggle");

        // Toggle mobile menu
        if (newHamburger) {
            newHamburger.addEventListener("click", function() {
                newMenuList.classList.toggle("active");
            });
        }

        // Toggle submenu items
        newSubmenuToggles.forEach(toggle => {
            toggle.addEventListener("click", function(e) {
                e.preventDefault();
                this.classList.toggle("open");
                this.nextElementSibling.classList.toggle("active");
            });
        });
    });
    </script>

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/slideNav.min.js"></script>
    <script src="js/slideNav.js"></script>
    <script src="js/script.js"></script>

</body>

</html>