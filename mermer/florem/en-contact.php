<?php
include 'db.php';

// Kategorileri ve alt kategorileri çek
$sql = "SELECT k.kategori_id, k.kategori_adi, a.alt_kategori_id, a.alt_kategori_adi
        FROM kategoriler_en k
        LEFT JOIN alt_kategoriler_en a ON k.kategori_id = a.kategori_id
        ORDER BY k.kategori_adi, a.alt_kategori_adi";

$result = $conn->query($sql);

$kategoriler = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $kid = $row['kategori_id'];
        if (!isset($kategoriler[$kid])) {
            $kategoriler[$kid] = [
                'kategori_adi' => $row['kategori_adi'],
                'alt_kategoriler' => []
            ];
        }
        if ($row['alt_kategori_id'] != null) {
            $kategoriler[$kid]['alt_kategoriler'][] = [
                'alt_kategori_id' => $row['alt_kategori_id'],
                'alt_kategori_adi' => $row['alt_kategori_adi']
            ];
        }
    }
}

$message = ''; // Form mesajını tutacak değişken

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // 1. Form verilerini al
    $isim = $conn->real_escape_string($_POST['isim']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefon = isset($_POST['telefon']) ? $conn->real_escape_string($_POST['telefon']) : '';
    $konu = $conn->real_escape_string($_POST['konu']);
    $mesaj = $conn->real_escape_string($_POST['mesaj']);

    // 2. Veritabanına ekle
    $sql = "INSERT INTO iletisim (isim, email, telefon, konu, mesaj) 
            VALUES ('$isim', '$email', '$telefon', '$konu', '$mesaj')";

    if ($conn->query($sql)) {
        $message = "<p style='color:green; font-weight:bold;'>Mesajınız başarıyla gönderildi!</p>";
    } else {
        $message = "<p style='color:red; font-weight:bold;'>Hata: ".$conn->error."</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Gramentheme">
    <meta name="description" content="Florem - Flooring & Tiling Html Template">
    <title>Marble Showcase</title>
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/meanmenu.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <style>
      .list-area {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        list-style: none;
        padding: 0;
        margin: 0;
      }
      .list-area li {
        width: 200px;
      }
      .list-area li a {
        text-decoration: none;
        color: #333;
        display: block;
      }
    </style>
</head>
<body>
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

    <button id="back-top" class="back-to-top">
        <i class="fa-solid fa-chevron-up"></i>
    </button>

  <!-- Offcanvas Area Start -->
<div class="fix-area">
  <div class="offcanvas__info">
    <div class="offcanvas__wrapper">
      <div class="offcanvas__content">
        <!-- Logo and Close Button -->
        <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
          <div class="offcanvas__logo">
            <a href="en-index.php">
              <img src="assets/images/logo/logo2.svg" alt="logo-img">
            </a>
          </div>
          <div class="offcanvas__close">
            <button><i class="fas fa-times"></i></button>
          </div>
        </div>

        <!-- Introduction Text -->
        <p class="text d-none d-xl-block">
        We bring Turkey's high-quality marbles to the world. Only sales, high quality, on-time delivery.
        </p>

        <!-- Language Selector -->
        <div class="language-switcher mb-4">
          <h4>Language</h4>
          <select onchange="location = this.value;" class="form-select mt-2">
            <option value="index2.php">🇹🇷 Turkish</option>
            <option value="en-index.php" selected>🇬🇧 English</option>
          </select>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu fix mb-3"></div>

        <!-- Contact Info -->
        <div class="offcanvas__contact">
          <h4>Contact Info</h4>
          <ul>
            <li class="d-flex align-items-center">
              <div class="offcanvas__contact-icon">
                <i class="fal fa-map-marker-alt"></i>
              </div>
              <div class="offcanvas__contact-text">
                <a target="_blank" href="#">Karasu / Sakarya</a>
              </div>
            </li>
            <li class="d-flex align-items-center">
              <div class="offcanvas__contact-icon mr-15">
                <i class="fal fa-envelope"></i>
              </div>
              <div class="offcanvas__contact-text">
                <a href="mailto:info@example.com">info@example.com</a>
              </div>
            </li>
            <li class="d-flex align-items-center">
              <div class="offcanvas__contact-icon mr-15">
                <i class="far fa-phone"></i>
              </div>
              <div class="offcanvas__contact-text">
                <a href="tel:+902122222222">+90 212 222 22 22</a>
              </div>
            </li>
          </ul>

          <!-- Quote Button -->
          <div class="header-button mt-4">
            <a href="en-contact.php" class="theme-btn text-center">
              <span>Get a Quote <i class="fa-solid fa-arrow-right-long"></i></span>
            </a>
          </div>

          <!-- Social Icons -->
          <div class="social-icon d-flex align-items-center mt-3">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
        <!-- /Contact Info -->
      </div>
    </div>
  </div>
</div>
<div class="offcanvas__overlay"></div>
<!-- Offcanvas Area End -->

<!-- Header Section Start -->
<header class="header-section-2">
  <div id="header-sticky" class="header-2">
    <div class="container">
        <div class="mega-menu-wrapper">
            <div class="header-main">
                <div class="header-left">
                    <div class="logo">
                        <a href="en-index.php" class="header-logo">
                            <img src="assets/images/logo/logo.svg" alt="logo-img">
                        </a>
                    </div>
                </div>
                <div class="header-middle">
                    <div class="mean__menu-wrapper">
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                  <ul>
    <li><a href="en-index.php">Home</a></li>
    <li><a href="en-about.php">About Us</a></li>

    <li class="has-dropdown">
        <a href="en-products.php">
            Products
            <i class="fas fa-angle-down"></i>
        </a>
        <ul class="submenu">
            <?php foreach($kategoriler as $kategori_id => $kategori): ?>
            <li class="has-dropdown">
                <a href="en-products.php?kategori_id=<?= $kategori_id ?>">
                    <?= htmlspecialchars($kategori['kategori_adi']); ?>
                </a>

                <?php if(!empty($kategori['alt_kategoriler'])): ?>
                <ul class="submenu">
                    <?php foreach($kategori['alt_kategoriler'] as $alt): ?>
                    <li>
                        <a href="en-products.php?alt_kategori_id=<?= $alt['alt_kategori_id']; ?>">
                            <?= htmlspecialchars($alt['alt_kategori_adi']); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </li>

    <li><a href="en-gallery.php">Gallery</a></li>
    <li><a href="en-faq.php">FAQ</a></li>
    <li><a href="en-contact.php">Contact</a></li>
</ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="header-right d-flex justify-content-end align-items-center">
                    <div class="header-contact-info style2">
                        <div class="icon"> <i class="fa-regular fa-phone" style="color: white;"></i> </div>
                        <div class="content">
                            <h6>Call Us</h6>
                            <h5><a href="tel:1234564566"> 0 (123) 456 45 66</a></h5>
                        </div>
                    </div>
                    <div class="header__hamburger d-xl-block my-auto">
                        <div class="sidebar__toggle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="21" viewBox="0 0 30 21"
                                fill="none">
                                <line y1="0.5" x2="20" y2="0.5" stroke="#2B1E16" />
                                <line y1="10.5" x2="30" y2="10.5" stroke="#2B1E16" />
                                <line y1="20.5" x2="20" y2="20.5" stroke="#2B1E16" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</header>

<!-- Breadcrumb Section START -->
<div class="breadcumb-section">
    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-content">
                        <h1 class="breadcumb-title">Contact</h1>
                        <ul class="breadcumb-menu">
                            <li><a href="en-index.php">Home</a></li>
                            <li class="text-white"><i class="fa-solid fa-chevrons-right"></i></li>
                            <li class="active">Contact</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Information Section -->
<div class="contact-section section-padding fix">
    <div class="container">
        <div class="row gy-5">
            <div class="col-xl-4 col-md-6">
                <div class="contact-info-box style1">
                    <div class="icon">
                        <img src="assets/icons/icon12.svg" alt="Address">
                    </div>
                    <h3 class="title">Our Address</h3>
                    <p class="info">Karasu / Sakarya</p>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="contact-info-box style2">
                    <div class="icon">
                        <img src="assets/icons/icon13.svg" alt="Email">
                    </div>
                    <h3 class="title">info@example.com</h3>
                    <p class="info">You can email us for any inquiries.</p>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="contact-info-box style1">
                    <div class="icon">
                        <img src="assets/icons/icon14.svg" alt="Phone">
                    </div>
                    <h3 class="title">Tel: +208-666-01112</h3>
                    <p class="info">You can reach us at this number for detailed information.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="map-section">
    <div class="map-container-wrapper style1 pb-262 fix">
        <div class="container">
            <div class="row">
                <div class="map-wrapper">
                   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d48103.36144700342!2d30.654229634499064!3d41.10264183944323!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x409ddad62ec03b6f%3A0x7a3f164055dabb5f!2sKarasu%2C%20Sakarya!5e0!3m2!1str!2str!4v1752646392193!5m2!1str!2str" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="contact-form-wrapper style2">
    <div class="container">
        <div class="row gx-60 d-flex justify-content-md-end justify-content-center">
            <div class="col-xl-6">
                <div class="contact-form style2">
                    <h2>Get in Touch</h2>

                    <!-- Message will appear here -->
                    <?php echo $message; ?>

                    <form class="row" action="" method="POST">
                        <div class="col-md-6">
                            <input type="text" name="isim" placeholder="Full Name *" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" placeholder="Email Address *" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <input type="tel" name="telefon" placeholder="Phone (optional)" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="konu" placeholder="Subject *" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <textarea name="mesaj" class="form-control" placeholder="Write your message here..." rows="5" required></textarea>
                        </div>
                        <div class="col-12 col-md-6 form-group mb-0">
                            <button type="submit" name="submit" class="btn-wrapper theme-btn style3" style="max-width: 350px;">
                                SEND
                                <img src="assets/icons/arrow-icon.svg" alt="Send">
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer Section -->
<footer class="footer-section position-relative fix bg-color1">
  <div class="footer-widgets-wrapper style2" data-bg-src="assets/images/bg/footerBg2_1.jpg">
    <div class="footer-top-wrapper style2 img-custom-anim-left wow fadeInUp" data-wow-delay=".3s">
      <div class="container">
        <div class="footer-top">
          <div class="row gy-4">
            <div class="col-lg-4">
              <div class="fancy-box">
                <div class="item1"><i class="fa-solid fa-location-dot"></i></div>
                <div class="item2">
                  <h6>Address</h6>
                  <p>Karasu / Sakarya</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 d-flex justify-content-start justify-content-lg-end">
              <div class="fancy-box">
                <div class="item1"><i class="fa-solid fa-envelope"></i></div>
                <div class="item2">
                  <h6>Email</h6>
                  <p>info@mermersitesi.com</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 d-flex justify-content-start justify-content-lg-end">
              <div class="fancy-box">
                <div class="item1"><i class="fa-regular fa-phone-volume"></i></div>
                <div class="item2">
                  <h6>Phone</h6>
                  <p>+90 123456456</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".2s">
          <div class="single-footer-widget">
            <div class="widget-head">
              <a href="en-index.php">
                <img src="assets/images/logo/logo4.svg" alt="logo-img">
              </a>
            </div>
            <div class="footer-content">
              <p>
                Bringing Turkey's finest marble to the world. Only sales, high quality, on-time delivery.
              </p>
              <div class="social-icon d-flex align-items-center">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".4s">
          <div class="single-footer-widget">
            <div class="widget-head">
              <h3>
                <img class="me-1" src="assets/images/shape/footertitleShape1_1.png" alt="shape"> Quick Links
              </h3>
            </div>
            <ul class="list-area">
              <li><a href="en-index.php"><i class="fa-solid fa-chevron-right"></i> Home</a></li>
              <li><a href="en-products.php"><i class="fa-solid fa-chevron-right"></i> Products</a></li>
              <li><a href="en-about.php"><i class="fa-solid fa-chevron-right"></i> About Us</a></li>
              <li><a href="en-faq.php"><i class="fa-solid fa-chevron-right"></i> FAQ</a></li>
              <li><a href="en-contact.php"><i class="fa-solid fa-chevron-right"></i> Contact</a></li>
            </ul>
          </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".6s">
          <div class="single-footer-widget">
            <div class="widget-head">
              <h3>
                <img class="me-1" src="assets/images/shape/footertitleShape1_1.png" alt="shape"> Product Groups
              </h3>
            </div>
            <ul class="list-area">
              <?php foreach($kategoriler as $kategori_id => $kategori): ?>
            <li class="has-dropdown">
                <a href="en-products.php?kategori_id=<?= $kategori_id ?>">
                    <?= htmlspecialchars($kategori['kategori_adi']); ?>
                </a>
            </li>
            <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="footer-bottom style2">
    <div class="container">
      <div class="footer-wrapper d-flex align-items-center justify-content-between">
        <p class="wow fadeInLeft" data-wow-delay=".3s">
          © 2025 All Rights Reserved
        </p>
        <ul class="brand-logo wow fadeInRight" data-wow-delay=".5s">
          <li><a class="text-white" href="#">Privacy Policy</a></li>
          <li><a class="text-white" href="#">Terms of Use</a></li>
          <li><a class="text-white" href="contact.php">Contact</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>
<!-- Footer End -->

   
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.waypoints.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/viewport.jquery.js"></script>
    <script src="assets/js/tilt.min.js"></script>
    <script src="assets/js/swiper-bundle.min.js"></script>
    <script src="assets/js/jquery.meanmenu.min.js"></script>
    <script src="assets/js/magnific-popup.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/nice-select.min.js"></script>
    <script src="assets/js/main.js"></script>
</html>
