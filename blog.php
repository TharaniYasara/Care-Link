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
$stmt = $pdo->query("SELECT blogs.*, users.name AS author_name FROM blogs JOIN users ON blogs.author_id = users.id ORDER BY blogs.date DESC");
$latestBlogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<head>
    <title>CareLink | Blog</title>
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
                <h2 class="section-subtitle ">a home filled with stories</h2>
                <h3 class="banner-title">Sharing Insights, Experiences, and Knowledge.</h3>
                <p>Explore our latest blog posts featuring inspiring stories, valuable insights, and expert advice. Stay
                    informed and engaged with fresh content that matters to you.
                </p>
                <div class="btn-wrap">
                    <a href="#latest-blog" class="btn-accent">Read More</a>
                </div>
            </div>
            <!--banner-content-->
            <figure>
                <img src="images/blog_header.png" alt="banner" class="banner-image">
            </figure>
        </div>
    </section>

    <button id="scrollToTopBtn">Top</button>

    <section id="latest-blog">
        <div class="container">
            <div class="row">
                <div class="inner-content">

                    <div class="grid" data-aos="fade-up">

                        <?php foreach ($latestBlogs as $blog) : ?>
                        <article class="column">
                            <figure>
                                <a href="readblog.php?id=<?= $blog['id']; ?>" class="image-hvr-effect">
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
                                        href="readblog.php?id=<?= $blog['id']; ?>"><?= htmlspecialchars($blog['title']); ?></a>
                                </h3>
                                <p class="meta-author">By
                                    <?= htmlspecialchars($blog['author_name']); ?></p>
                            </div>
                        </article>
                        <?php endforeach; ?>
                    </div>
                    <!--grid-->
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
                                    <a href="#" class="btn-accent">Contact us</a>
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