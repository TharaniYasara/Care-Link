<!DOCTYPE html>
<html lang="en">

<?php
require 'admin/db.php'; // Include your database connection

// Fetch all active events
$stmt = $pdo->prepare("SELECT title, event_date, description, event_image FROM events ORDER BY event_date DESC");
$stmt->execute();
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
// Fetch latest 3 blog posts
$stmt = $pdo->query("SELECT blogs.*, users.name AS author_name FROM blogs JOIN users ON blogs.author_id = users.id ORDER BY blogs.date DESC LIMIT 3");
$latestBlogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
    <title>CareLink</title>
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
                                    <li class="menu-item"><a href="#about" class="nav-link"
                                            data-effect="About">About</a></li>
                                    <li class="menu-item"><a href="#projects" class="nav-link"
                                            data-effect="Events">Events</a></li>
                                    <li class="menu-item"><a href="#testimonial" class="nav-link"
                                            data-effect="Donations">Donations</a></li>
                                    <li class="menu-item"><a href="#services" class="nav-link"
                                            data-effect="Adoption">Adoption</a></li>
                                    <li class="menu-item"><a href="contact.php" class="nav-link"
                                            data-effect="Contact">Contact</a></li>
                                    <li class="menu-item"><a href="blog.php" class="nav-link"
                                            data-effect="Blog">Blog</a></li>
                                    <li class="menu-item"><a href="admin/auth/sign-in.php" class="nav-link"
                                            data-effect="Account">Account</a></li>
                                </ul>
                            </div>

                            <a href="sign_in.html" class="btn-hvr-effect">
                                <span>Sign In</span>
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

                                    <li class="new-menu-item active"><a href="index.php" class="nav-link"
                                            data-effect="Home">Home
                                        </a></li>
                                    <li class="new-menu-item"><a href="#about" class="nav-link"
                                            data-effect="About">About
                                        </a></li>
                                    <li class="new-menu-item"><a href="#projects" class="nav-link"
                                            data-effect="Events">Events
                                        </a></li>
                                    <li class="new-menu-item"><a href="#testimonial" class="nav-link"
                                            data-effect="Donations">Donations
                                        </a></li>
                                    <li class="new-menu-item"><a href="#services" class="nav-link"
                                            data-effect="Adoption">Adoption
                                        </a></li>
                                    <li class="new-menu-item"><a href="contact.php" class="nav-link"
                                            data-effect="Contact">Contact
                                        </a></li>
                                    <li class="new-menu-item"><a href="blog.php" class="nav-link"
                                            data-effect="Blog">Blog
                                        </a></li>
                                    <li class="new-menu-item"><a href="account.html" class="nav-link"
                                            data-effect="Account">Account
                                        </a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <!--header-wrap-->

    <section id="billboard">
        <div class="main-banner pattern-overlay">
            <div class="banner-content" data-aos="fade-up">
                <h2 class="section-subtitle ">a home filled with love</h2>
                <h3 class="banner-title">Providing a Safe and Caring Future for Every Child.</h3>
                <p>Every child deserves a loving home. We are dedicated to offering shelter, education, and emotional
                    support to build a better tomorrow.</p>
                <div class="btn-wrap">
                    <a href="#about" class="btn-accent">Get Involved</a>
                </div>
            </div>
            <!--banner-content-->
            <figure>
                <img src="images/main-banner.png" alt="banner" class="banner-image">
            </figure>
        </div>
    </section>

    <button id="scrollToTopBtn">Top</button>

    <section id="about">
        <div class="container">
            <div class="row">
                <div class="inner-content">
                    <div class="company-detail">
                        <div class="grid">
                            <figure>
                                <img src="images/single-image.png" alt="book" class="single-image">
                            </figure>
                            <div class="detail-entry" data-aos="fade-up">

                                <div class="section-header">
                                    <h2 class="section-subtitle liner">about us</h2>
                                    <h3 class="section-title">Empowering Children Through Education & Care</h3>
                                </div>

                                <div class="detail-wrap">
                                    <p>At CareLink Orphanage, we believe that every child deserves access to education,
                                        healthcare, and emotional support. We strive to equip them with the skills and
                                        confidence to shape their own futures.</p>
                                    <div class="btn-wrap">
                                        <a href="#services" class="btn-accent">Read More</a>
                                    </div>
                                </div>
                                <!--description-->
                            </div>
                        </div>
                        <!--grid-->
                    </div>
                </div>
                <!--inner-content-->
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="inner-content">
                    <div class="service-content">
                        <div class="grid">
                            <div class="detail-entry">

                                <div class="section-header">
                                    <h2 class="section-subtitle liner">adoption process</h2>
                                    <h3 class="section-title">Your Journey to Giving a Child a Loving Home</h3>
                                </div>

                                <div class="detail-wrap">
                                    <p>Adopting a child is a life-changing experience. Our step-by-step adoption process
                                        ensures that every child is placed in a caring and supportive home. From
                                        application to final approval, we guide you every step of the way.</p>
                                    <div class="btn-wrap">
                                        <a href="admin/pages/adoption_application.html" class="btn-accent">Start
                                            Application</a>
                                        <a href="#testimonial" class="btn-accent"
                                            style="margin-left: 15px; background: transparent; border: 2px solid; color: #e74c3c;">Learn
                                            More</a>
                                    </div>
                                </div>
                                <!--detail-wrap-->
                            </div>

                            <div class="service-grid grid" data-aos="fade-up">

                                <div class="column odd-column">
                                    <div class="icon-box">
                                        <img src="images/adopt1.png" alt="adoption">
                                    </div>
                                    <div class="icon-box">
                                        <img src="images/adopt2.png" alt="adoption">
                                    </div>
                                </div>

                                <div class="column">
                                    <div class="icon-box">
                                        <img src="images/adopt3.png" alt="adoption">
                                    </div>
                                    <div class="icon-box">
                                        <img src="images/adopt4.png" alt="adoption">

                                    </div>
                                    <div class="icon-box">
                                        <img src="images/adopt5.png" alt="adoption">

                                    </div>
                                </div>

                                <div class="column odd-column">
                                    <div class="icon-box">
                                        <img src="images/adopt6.png" alt="adoption">

                                    </div>
                                    <div class="icon-box">
                                        <img src="images/adopt7.png" alt="adoption">
                                    </div>
                                </div>


                            </div>

                        </div>
                        <!--grid-->
                    </div>

                </div>
                <!--inner-content-->
            </div>
        </div>
        </div>
    </section>

    <section id="projects">
        <div class="container">
            <div class="row">
                <div class="inner-content">

                    <div class="grid">

                        <div class="section-header">
                            <h2 class="section-subtitle liner">Latest</h2>
                            <h3 class="section-title">Events & Announcements</h3>
                        </div>
                    </div>
                    <!--grid-->

                    <div class="tab-content">

                        <div id="all" data-tab-content class="active" data-aos="fade-up">

                            <div class="grid project-grid">

                                <?php foreach ($events as $event): 
                                // Modify image path
                                $eventImagePath = str_replace("../assets/img/", "admin/assets/img/", $event['event_image']);
                            ?>
                                <figure class="project-style hvr-grayscale">
                                    <img src="<?= !empty($event['event_image']) ? $eventImagePath : 'admin/assets/img/calendar.png'; ?>"
                                        alt="<?= htmlspecialchars($event['title']); ?>" class="project-item">
                                    <figcaption>
                                        <h3><?= htmlspecialchars($event['title']); ?></h3>
                                        <div class="category-title">
                                            <b>
                                                <?= date("d/m/Y", strtotime($event['event_date'])); ?>
                                            </b>
                                            <span>
                                                <i>
                                                    12:00PM</i>
                                            </span>
                                        </div>
                                    </figcaption>

                                    <p><?= htmlspecialchars($event['description']); ?></p>
                                </figure>
                                <?php endforeach; ?>


                            </div>

                        </div>
                    </div>

                </div>
                <!--inner-content-->
            </div>
        </div>

    </section>

    <section id="testimonial">
        <div class="container">
            <div class="row">
                <div class="inner-content">
                    <div class="grid">

                        <div class="section-header">
                            <h2 class="section-subtitle liner">make a difference</h2>
                            <h3 class="section-title">Your Support Changes Lives</h3>
                            <p>Every contribution helps us provide food, shelter, and education to children in need.
                                Join us in creating a brighter future!</p>
                            <div class="btn-wrap">
                                <a href="admin/auth/sign-in.php" class="btn-accent">Make a Donation</a>
                            </div>
                        </div>


                        <div class="testimonial-content" data-aos="fade-up">

                            <div class="testimonial-slider">
                                <div class="testimonial-item">
                                    <div class="author-thumb">
                                        <img src="images/keshala.jpeg" alt="testimonial" class="review-image">
                                    </div>

                                    <div class="author-detail">
                                        <q>Education is the key to breaking the cycle of poverty. By donating to
                                            CareLink Orphanage, I know I’m helping a child get the learning
                                            opportunities they deserve. Every child deserves a chance to dream!</q>
                                        <div class="author-name">Keshala Aberathne</div>
                                        <div class="author-profession">Teacher</div>
                                    </div>
                                </div>
                                <div class="testimonial-item">
                                    <div class="author-thumb">
                                        <img src="images/achintha.jpeg" alt="testimonial" class="review-image">
                                    </div>

                                    <div class="author-detail">
                                        <q>Giving back is not just about money, it’s about hope. These children have
                                            limitless potential, and a small contribution from us can change their
                                            entire future. Let’s stand together and support them!</q>
                                        <div class="author-name">Achintha Sathsara</div>
                                        <div class="author-profession">Entrepreneur</div>
                                    </div>
                                </div>
                            </div>
                            <!--testimonial-slider-->

                            <div class="button-container">
                                <button class="prev slick-arrow">
                                    <i class="icon icon-arrow-left"></i>
                                </button>
                                <button class="next slick-arrow">
                                    <i class="icon icon-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        <!--testimonial-content-->

                    </div>
                    <!--grid-->
                </div>
                <!--inner-content-->
            </div>
        </div>
    </section>

    <section id="latest-blog">
        <div class="container">
            <div class="row">
                <div class="inner-content">

                    <div class="section-header align-center">
                        <h2 class="section-subtitle">blogs</h2>
                        <h3 class="section-title">Latest blog posts</h3>
                    </div>

                    <div class="grid" data-aos="fade-up">

                        <?php foreach ($latestBlogs as $blog) : ?>
                        <article class="column">
                            <figure>
                                <a href="blog-details.php?id=<?= $blog['id']; ?>" class="image-hvr-effect">
                                    <img src="admin/assets/uploads/blogs/<?= htmlspecialchars($blog['image']); ?>"
                                        alt="post" class="post-image">
                                </a>
                            </figure>

                            <div class="post-item">
                                <div class="meta-tag">
                                    <div class="meta-date"><?= date("M d, Y", strtotime($blog['date'])); ?></div>
                                    <a href="#" class="categories"><?= htmlspecialchars($blog['category']); ?></a>
                                </div>

                                <h3 class="post-title">
                                    <a
                                        href="blog-details.php?id=<?= $blog['id']; ?>"><?= htmlspecialchars($blog['title']); ?></a>
                                </h3>
                                <p class="meta-author">By
                                    <?= htmlspecialchars($blog['author_name']); ?></p>
                            </div>
                        </article>
                        <?php endforeach; ?>
                    </div>
                    <!--grid-->

                    <center>
                        <div class="btn-wrap">
                            <a href="blog.php" class="btn-accent">View All Blogs</a>
                        </div>
                    </center>

                </div>
            </div>
        </div>
    </section>

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
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">About</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Events</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Donations</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="#">Adoption</a>
                                    </li>
                                </ul>
                            </div>


                            <div class="footer-item">
                                <h2>Let's Talk</h2>
                                <p>Looking to volunteer, donate, or collaborate on child welfare projects? We’d love to
                                    hear from you. Let’s work together to create a better future for every child.</p>
                                <div class="btn-wrap">
                                    <a href="contact.php" class="btn-accent">Contact us</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--footer-menu-list-->
                </div>
                <!--inner-content-->
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
            <!--grid-->
        </div>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const newHamburger = document.getElementById("new-hamburger");
        const newMenuList = document.getElementById("new-menu-list");
        const newSubmenuToggles = document.querySelectorAll(".new-submenu-toggle");

        // Toggle mobile menu
        newHamburger.addEventListener("click", function() {
            newMenuList.classList.toggle("active");
        });

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