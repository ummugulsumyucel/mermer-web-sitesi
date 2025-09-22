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

<!-- About Section START -->
<section class="about-section">
  <div class="about-container-wrapper style2 section-padding fix bg-white" data-bg-src="assets/images/bg/aboutBg2_1.jpg">
    <div class="container">
      <div class="about-wrapper style2">
        <div class="row gy-5 gx-60">
          <div class="col-xl-6">
            <div class="about-thumb img-custom-anim-left wow fadeInUp" data-wow-delay=".3s">
              <img class="thumb1" src="assets/images/about/aboutThumb2_1.jpg" alt="thumb">
              <img class="thumb2" src="assets/images/about/aboutThumb2_2.jpg" alt="thumb">
            </div>
          </div>
          <div class="col-xl-6">
            <div class="about-content">
              <div class="section-title text-start mt-70">
                <div class="subtitle text-start wow fadeInUp" data-wow-delay=".5s">
                  <img class="me-1" src="assets/images/shape/titleShape1_1.png" alt="icon">
                  ABOUT US
                </div>
                <h2 class="text-start mt-15 wow fadeInUp" data-wow-delay=".3s">
                  Reliable Supplier in <br> Natural Stone and Marble
                </h2>
                <p class="desc wow fadeInUp" data-wow-delay=".5s">
                  Our company supplies high-quality natural stone and marble products for architectural projects worldwide. With our wide product range, sustainable production approach, and on-time delivery guarantee, we are a preferred partner internationally.
                </p>
              </div>
              <h3>Where quality, aesthetics, and trust meet.</h3>
              <div class="row exp-area">
                <div class="col-xl-12">
                  <div class="progress-wrap style2 wow fadeInUp" data-wow-delay=".2s">
                    <div class="progress-meta img-custom-anim-left wow fadeInUp" data-wow-delay=".3s">
                      <div class="title">International Export Network</div>
                      <div class="percentage">95%</div>
                    </div>
                    <div class="progress-container">
                      <div class="progress-bar" style="width: 95%;"></div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-12">
                  <div class="progress-wrap style2 wow fadeInUp" data-wow-delay=".2s">
                    <div class="progress-meta img-custom-anim-left wow fadeInUp" data-wow-delay=".5s">
                      <div class="title">Product Variety & Customization</div>
                      <div class="percentage">90%</div>
                    </div>
                    <div class="progress-container">
                      <div class="progress-bar" style="width: 90%;"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- About Section END -->

<!-- Company History Section START -->
<div class="history-section section-padding fix">
    <div class="container">
        <div class="history-wrapper style1">
            <h2 class="history-title">Company History</h2>
            <div class="row gy-5 gx-60">
                <div class="col-xl-6">
                    <div class="history-thumb">
                        <img src="assets/images/history/history1_1.jpg" alt="History Image">
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="history-content">
                        <h2>A Strong Brand in the Global Market</h2>
                        <p class="text">
                            Our company processes marble, one of Turkey’s natural treasures, to the highest quality standards and delivers it to world markets. Through our exports to many countries, primarily Europe, the Middle East, and North Africa, we have become a trusted business partner in the industry.
                            <br><br>
                            Special cut marbles, mosaics, and natural stone varieties in our product portfolio are meticulously prepared to add aesthetics, durability, and prestige to projects. We emphasize quality control at every stage from production to shipment and ensure timely and complete delivery to our customers.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Company History Section END -->

<!-- Testimonials Section START -->
<div class="testimonial-section section-padding pt-0">
    <div class="testimonial-container-wrapper style1">
        <div class="container">
            <div class="row d-flex align-items-end mt-70 mb-60">
                <div class="col-xl-6">
                    <div class="section-title text-start mxw-530">
                        <div class="subtitle text-start wow fadeInUp" data-wow-delay=".5s">
                            <img class="me-1" src="assets/images/shape/titleShape1_1.png" alt="icon">
                            TESTIMONIALS
                        </div>
                        <h2 class=" text-start mt-15 wow fadeInUp" data-wow-delay=".3s">
                            What Our Customers Say About Us
                        </h2>
                    </div>
                </div>
                <div class="col-xl-6 d-flex justify-content-start justify-content-xl-end mt-4 mt-xl-0">
                    <div class="slider-arrow-btn text-end wow fadeInUp" data-wow-delay=".9s">
                        <button data-slider-prev="#testimonialSliderOne" class="slider-arrow style1">
                            <i class="fa-solid fa-arrow-left-long"></i>
                        </button>
                        <button data-slider-next="#testimonialSliderOne" class="slider-arrow style1 slider-next">
                            <i class="fa-solid fa-arrow-right-long"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="slider-area testimonialSliderOne fix text-center">
                <div class="swiper gt-slider" id="testimonialSliderOne"
                    data-slider-options='{"loop": true,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":1,"centeredSlides":true},"768":{"slidesPerView":1},"992":{"slidesPerView":2},"1200":{"slidesPerView":2}}}'>
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-card-items style1 wow fadeInUp" data-wow-delay=".5s"
                                data-bg-src="assets/images/bg/testimonialBg1_1.png">
                                <div class="shape"><img src="assets/images/shape/testimonialCardShape1_1.png" alt="shape"></div>
                                <div class="profile-meta">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/testimonialProfile1_1.png" alt="profile">
                                    </div>
                                    <div class="content">
                                        <h6>Ayşe Demir</h6>
                                        <p>Architect</p>
                                    </div>
                                </div>
                                <div class="body">
                                    <p>I ordered specially cut marble for my project. I was very satisfied with both the material quality and on-time delivery. I definitely recommend them!</p>
                                    <ul class="star-wrapper style1">
                                        <li><img src="assets/images/icon/starIcon.svg" alt="star"></li>
                                        <li><img src="assets/images/icon/starIcon.svg" alt="star"></li>
                                        <li><img src="assets/images/icon/starIcon.svg" alt="star"></li>
                                        <li><img src="assets/images/icon/starIcon.svg" alt="star"></li>
                                        <li><img src="assets/images/icon/starIcon.svg" alt="star"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-card-items style1 wow fadeInUp" data-wow-delay=".7s"
                                data-bg-src="assets/images/bg/testimonialBg1_1.png">
                                <div class="shape"><img src="assets/images/shape/testimonialCardShape1_1.png" alt="shape"></div>
                                <div class="profile-meta">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/testimonialProfile1_2.png" alt="profile">
                                    </div>
                                    <div class="content">
                                        <h6>Mehmet Yılmaz</h6>
                                        <p>Construction Manager</p>
                                    </div>
                                </div>
                                <div class="body">
                                    <p>We sourced natural stone for our international projects. The company was very professional both in pricing and export procedures.</p>
                                    <ul class="star-wrapper style1">
                                        <li><img src="assets/images/icon/starIcon.svg" alt="star"></li>
                                        <li><img src="assets/images/icon/starIcon.svg" alt="star"></li>
                                        <li><img src="assets/images/icon/starIcon.svg" alt="star"></li>
                                        <li><img src="assets/images/icon/starIcon.svg" alt="star"></li>
                                        <li><img src="assets/images/icon/starIcon.svg" alt="star"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="slider-pagination"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonials Section END -->

<!-- Facts Section START -->
<section class="facts-section section-padding pb-0 fix bg-theme2">
    <div class="container">
        <div class="facts-wrapper style1">
            <div class="facts-title">Facts and Figures</div>
            <div class="row">
                <div class="facts-box-wrapper style1">
                    <div class="facts-box">
                        <h3><span class="counter-number">15</span> <span>+</span></h3>
                        <p class="text">Countries Exported</p>
                    </div>
                    <div class="facts-box">
                        <h3><span class="counter-number">50</span> <span>+</span></h3>
                        <p class="text">Marble Varieties</p>
                    </div>
                    <div class="facts-box">
                        <h3><span class="counter-number">500</span> <span>+</span></h3>
                        <p class="text">Satisfied Customers</p>
                    </div>
                    <div class="facts-box">
                        <h3><span class="counter-number">1200</span> <span>+</span></h3>
                        <p class="text">Total Sales</p>
                    </div>
                    <div class="facts-box">
                        <h3><span class="counter-number">30</span> <span>+</span></h3>
                        <p class="text">Happy & Loyal Customers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Facts Section END -->

<!-- Skills Section START -->
<section class="skills-section fix">
  <div class="skills-container-wrapper style2 section-padding fix">
    <div class="shape">
      <img src="assets/images/shape/skillsShape2_1.png" alt="shape">
    </div>
    <div class="container">
      <div class="skills-wrapper style2">
        <div class="row gy-5">
          <div class="col-xl-7">
            <div class="skills-content">
              <div class="section-title text-start mt-70">
                <div class="subtitle text-start wow fadeInUp" data-wow-delay=".5s">
                  <img class="me-1" src="assets/images/shape/titleShape1_1.png" alt="icon">
                  EXPERTISE
                </div>
                <h2 class="text-start mt-15 wow fadeInUp" data-wow-delay=".3s">
                  Marble Products Where <br> Aesthetics Meet Quality
                </h2>
                <p class="desc wow fadeInUp" data-wow-delay=".5s">
                  Our high-quality marble blocks and slabs provide harmony with every project through their natural patterns, durability, and variety. We have partnered in hundreds of projects both domestically and internationally.
                </p>
              </div>

              <div class="checklist-wrapper style1">
                <ul class="checklist style2 img-custom-anim-left wow fadeInUp" data-wow-delay=".3s">
                  <li>
                    <img src="assets/icons/icon5.svg" alt="">
                    High Heat Resistance
                  </li>
                  <li>
                    <img src="assets/icons/icon5.svg" alt="">
                    Low Maintenance Requirement
                  </li>
                </ul>
                <ul class="checklist style2 img-custom-anim-left wow fadeInUp" data-wow-delay=".5s">
                  <li>
                    <img src="assets/icons/icon5.svg" alt="">
                    Natural Vein Patterns
                  </li>
                  <li>
                    <img src="assets/icons/icon5.svg" alt="">
                    Premium Quality Standards
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-5">
            <div class="skills-thumb">
              <div class="thumb1">
                <img src="assets/images/intro/4.jpg" style="width: 300px; height:  280px;" alt="thumb">
              </div>
              <div class="thumb2">
                <img src="assets/images/intro/5.jpg" style="width: 300px; height:  280px;" alt="thumb">
              </div>
              <div class="counter-box style2">
                <div class="counter">
                  <span class="counter-number"> 25 </span> <span>+</span>
                </div>
                <h6>Years of Industry Experience</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Skills Section END -->

<!-- Values Section START -->
<section class="values-section section-padding fix">
    <div class="container">
        <div class="values-wrapper style1">
            <div class="values-title">Our Values</div>
            <div class="row gy-5">
                <div class="col-xl-6">
                    <div class="values-box style1 wow fadeInUp" data-wow-delay=".3s">
                        <div class="icon">
                            <img src="assets/icons/icon8.svg" alt="Integrity">
                        </div>
                        <div class="content">
                            <h3>Integrity</h3>
                            <p>We conduct our work with honesty and transparency, always prioritizing your trust.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="values-box style1 wow fadeInUp" data-wow-delay=".5s">
                        <div class="icon">
                            <img src="assets/icons/icon9.svg" alt="Passion">
                        </div>
                        <div class="content">
                            <h3>Passion</h3>
                            <p>We are passionately committed to quality and customer satisfaction in the marble and natural stone sector.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="values-box style1 wow fadeInUp" data-wow-delay=".7s">
                        <div class="icon">
                            <img src="assets/icons/icon10.svg" alt="Adaptability">
                        </div>
                        <div class="content">
                            <h3>Adaptability</h3>
                            <p>We quickly adapt to changing market conditions to provide you with the best solutions.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="values-box style1 wow fadeInUp" data-wow-delay=".8s">
                        <div class="icon">
                            <img src="assets/icons/icon11.svg" alt="Care">
                        </div>
                        <div class="content">
                            <h3>Care</h3>
                            <p>We prepare every product and service meticulously to maintain our high-quality standards.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Values Section END -->


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
          <li><a class="text-white" href="en-contact.php">Contact</a></li>
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
