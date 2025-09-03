<?php
require 'admin/db.php'; // Include your database connection

// Get blog ID from URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: blog.php"); // Redirect if invalid ID
    exit;
}

$blogId = $_GET['id'];

// Fetch blog post from the database
$stmt = $pdo->prepare("SELECT blogs.*, users.name AS author_name FROM blogs JOIN users ON blogs.author_id = users.id WHERE blogs.id = ?");
$stmt->execute([$blogId]);
$blog = $stmt->fetch(PDO::FETCH_ASSOC);

// If blog post not found, redirect to blog page
if (!$blog) {
    header("Location: blog.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>CareLink | <?= htmlspecialchars($blog['title']); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

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

                            <a href="blog.php" class="btn-hvr-effect">
                                <span>Go Back</span>
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

    <section id="blog-post">
        <div class="container">
            <div class="row">
                <div class="inner-content">
                    <div class="single-blog-wrapper" style="max-width: 75%; margin: auto; padding: 40px 0;">
                        <article class="blog-content">
                            <figure class="blog-image">
                                <img src="admin/assets/uploads/blogs/<?= htmlspecialchars($blog['image']); ?>"
                                    alt="<?= htmlspecialchars($blog['title']); ?>" class="post-image">
                            </figure>

                            <div class="post-meta">
                                <h1 class="blog-title"><?= htmlspecialchars($blog['title']); ?></h1>
                                <div class="meta-info">
                                    <span class="meta-date"><?= date("M d, Y", strtotime($blog['date'])); ?></span> |
                                    <span class="meta-author">By <?= htmlspecialchars($blog['author_name']); ?></span> |
                                    <span class="meta-category"><?= htmlspecialchars($blog['category']); ?></span>
                                </div>
                            </div>
                            <br><br>

                            <div class="blog-description">
                                <p><?= nl2br(htmlspecialchars($blog['description'])); ?></p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="footer-bottom">
        <div class="container">
            <div class="grid">
                <div class="copyright">
                    <p>© 2025 <a href="#">CareLink.</a> All rights reserved.</p>
                </div>
                <div class="social-links">
                    <ul>
                        <li><a href="#"><i class="icon icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon icon-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/script.js"></script>

</body>

</html>