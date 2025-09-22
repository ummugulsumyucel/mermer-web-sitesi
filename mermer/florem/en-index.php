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

$sql = "SELECT baslik, resim FROM galeri ORDER BY id DESC"; 
$result = $conn->query($sql);
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
    flex-wrap: wrap; /* Çok uzun olursa alt satıra geçer */
    gap: 20px; /* Sütunlar arası boşluk */
    list-style: none;
    padding: 0;
    margin: 0;
}

.list-area li {
    width: 200px; /* Her sütun genişliği, ihtiyaca göre değiştir */
}

.list-area li a {
    text-decoration: none;
    color: #333;
    display: block;
}



.team-thumb {
    width: 100%;
    height: 250px; /* istediğin sabit yükseklik */
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
}

.team-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover; /* resmi kutuya göre kırpar */
    border-radius: 10px; /* istersen köşe yumuşatma */
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
<!-- Intro Section  S T A R T -->
<div class="intro-section fix">
  <div class="slider-area introSliderOne">
    <div class="swiper gt-slider" id="introSliderOne" data-slider-options='{"loop": true, "effect": "fade"}'>
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <div class="intro-wrapper style1 fix section-padding bg-img">
            <div class="shape"><img src="assets/images/shape/heroShape1_1.png" alt="shape"></div>
            <div class="gt-hero-bg" data-bg-src="assets/images/bg/introBg1_1.jpg"></div>
            <div class="container">
              <div class="intro-content-wrapper style1" data-animation="slideInLeft" data-duration="2s" data-delay="0.3s">
                <div class="row gy-5 d-flex align-items-center">
                  <div class="col-xl-6">
                    <div class="intro-content">
                      <div class="section-title text-start mt-70">
                        <div class="subtitle text-start" data-ani="slideindown" data-ani-delay="0.3s">
                          <img class="me-1" src="assets/images/shape/titleShape1_1.png" alt="icon">
                          Global Solutions in Natural Stone and Marble
                        </div>
                        <h1 class="text-start mt-15" data-ani="slideindown" data-ani-delay="0.5s">
                          Natural Stone Solutions <br> Adding Value to Your Projects
                        </h1>
                        <p class="desc" data-ani="slideinup" data-ani-delay="0.8s">
                          We provide aesthetic and durable solutions for interior and exterior projects with high-quality marble and natural stone products. 
                          Reliable export services ensure delivery worldwide.
                        </p>
                      </div>
                      <div class="btn-wrapper style2" data-ani="slideinup" data-ani-delay="1s">
                        <a href="en-contact.php" class="theme-btn style3">
                          LEARN MORE
                          <img src="assets/icons/arrow-icon.svg" alt="Arrow Icon" width="41" height="26">
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="intro-thumb" data-ani="slideinright" data-ani-delay="0.7s">
                      <img src="assets/images/intro/5.jpg" alt="thumb" style="border-radius: 30px;">
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
</div>

<!-- Product Categories Section START -->
<section class="service-section section-padding fix">
  <div class="service-container-wrapper style2">
    <div class="shape">
      <img src="assets/images/shape/serviceShape2_1.png" alt="shape">
    </div>
    <div class="service-container-title-wrapper style2">
      <div class="container">
        <div class="row d-flex align-items-center mb-50">
          <div class="col-xl-6">
            <div class="section-title text-start">
              <div class="subtitle text-start wow fadeInUp" data-wow-delay=".5s">
                <img class="me-1" src="assets/images/shape/titleShape1_1.png" alt="icon">
                PRODUCT CATEGORIES
              </div>
              <h2 class="text-start mt-15 wow fadeInUp" data-wow-delay=".3s">
                Marble Products Suitable <br> For Every Project
              </h2>
            </div>
          </div>
          <div class="col-xl-6 d-flex justify-content-start justify-content-xl-end mt-4 mt-xl-0">
            <div class="btn-wrapper style2">
              <a href="en-product.php" class="theme-btn style2">
                VIEW ALL PRODUCTS
                <img src="assets/icons/arrow-icon.svg" alt="Arrow Icon" width="41" height="26">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row gy-5">
        <div class="col-xl-3 col-md-6">
          <div class="service-card style2 background-image" data-tilt data-tilt-max="10">
            <div class="content">
              <div class="number">01</div>
              <h3><a href="en-product-details.php">Industrial Marble Sales</a></h3>
              <p class="text">Bulk marble supply for factories, malls, and large-scale projects.</p>
              <div class="icon">
                <img src="assets/icons/icon1.svg" alt="Category Icon">
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="service-card style2 background-image" data-tilt data-tilt-max="15">
            <div class="content">
              <div class="number">02</div>
              <h3><a href="en-product-details.php">Floor & Wall Marble</a></h3>
              <p class="text">Natural stone products suitable for both interior and exterior surfaces.</p>
              <div class="icon">
                <img src="assets/icons/icon2.svg" alt="Category Icon">
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="service-card style2 background-image" data-tilt data-tilt-max="10">
            <div class="content">
              <div class="number">03</div>
              <h3><a href="en-product-details.php">Decorative Marble Varieties</a></h3>
              <p class="text">Special marble options for kitchens, bathrooms, stairs, and interiors.</p>
              <div class="icon">
                <img src="assets/icons/icon3.svg" alt="Category Icon">
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="service-card style2 background-image" data-tilt data-tilt-max="12">
            <div class="content">
              <div class="number">04</div>
              <h3><a href="en-product-details.php">Export & Logistics</a></h3>
              <p class="text">Packaging and shipping process for customers worldwide.</p>
              <div class="icon">
                <img src="assets/icons/icon4.svg" alt="Category Icon">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Product Categories Section END -->
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
                  Trusted Supplier in <br> Natural Stone and Marble
                </h2>
                <p class="desc wow fadeInUp" data-wow-delay=".5s">
                  Our company supplies high-quality natural stone and marble products for architectural projects around the world. 
                  With our extensive product range, sustainable production approach, and on-time delivery guarantee, we are a preferred international partner.
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
              <div class="btn-wrapper style2 wow fadeInUp" data-wow-delay=".5s">
                <a href="en-about.php" class="theme-btn style3">
                  DISCOVER MORE
                  <img src="assets/icons/arrow-icon.svg" alt="Arrow Icon">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- About Section END -->

<!-- Skills Section START -->
<section class="skills-section fix">
  <div class="skills-container-wrapper style2 section-padding fix">
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
                  Marble Products Where <br> Aesthetics and Quality Meet
                </h2>
                <p class="desc wow fadeInUp" data-wow-delay=".5s">
                  Our high-quality marble blocks and slabs adapt to every project with their natural patterns, durability, and variety. 
                  We have been a solution partner for hundreds of projects domestically and internationally.
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
                <img src="assets/images/intro/7.jpg" alt="thumb" style="width: 300px; height: 340px;">
              </div>
              <div class="counter-box style2">
                <div class="counter">
                  <span class="counter-number"> 10 </span> <span>+</span>
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

<!-- FAQ Section START -->
<section class="faq-section section-padding pt-0 fix">
  <div class="container">
    <div class="faq-wrapper style1">
      <div class="faq-left">
        <div class="section-title text-start mt-70">
          <div class="subtitle text-start wow fadeInUp" data-wow-delay=".5s">
            <img class="me-1" src="assets/images/shape/titleShape1_1.png" alt="icon"> FREQUENTLY ASKED QUESTIONS
          </div>
          <h2 class="text-start mt-15 wow fadeInUp" data-wow-delay=".7s">
            Most Asked Questions
          </h2>
          <p class="desc wow fadeInUp" data-wow-delay=".9s">
            We have compiled the most common questions about our marble products and export processes for you.
          </p>
        </div>
        <div class="faq-box style1 img-custom-anim-left wow fadeInUp" data-wow-delay=".3s">
          <div class="header">
            <div class="icon">
              <img src="assets/images/icon/faqIcon1_1.svg" alt="icon">
            </div>
            <h6>
              <span class="counter-number"> 10 </span>+
              <span class="counter-text"> Years </span> Experience
            </h6>
          </div>
          <p class="text">
            With years of experience, we deliver high-quality marble products to customers worldwide.
          </p>
        </div>
      </div>
      <div class="faq-right">
        <div class="faq-content style1">
          <div class="faq-accordion">
            <div class="accordion" id="accordion">
              <div class="accordion-item mb-3 wow fadeInUp" data-wow-delay=".3s">
                <h5 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq1" aria-expanded="false" aria-controls="faq1">
                    01. What types of marble products do you offer?
                  </button>
                </h5>
                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#accordion">
                  <div class="accordion-body">
                    Our product portfolio includes White Carrara, Emperador Brown, Travertine, Granite, and many other natural stone varieties.
                  </div>
                </div>
              </div>
              <div class="accordion-item mb-3 wow fadeInUp" data-wow-delay=".5s">
                <h5 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                    02. How do your export processes work?
                  </button>
                </h5>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordion">
                  <div class="accordion-body">
                    We perform worldwide exports with packaging and logistics services compliant with international quality standards.
                  </div>
                </div>
              </div>
              <div class="accordion-item mb-3 wow fadeInUp" data-wow-delay=".7s">
                <h5 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                    03. Is there a quality guarantee for the products?
                  </button>
                </h5>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordion">
                  <div class="accordion-body">
                    All our products undergo quality control, and their durability and aesthetic standards are guaranteed.
                  </div>
                </div>
              </div>
              <div class="accordion-item mb-3 wow fadeInUp" data-wow-delay=".9s">
                <h5 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                    04. What is the minimum order quantity?
                  </button>
                </h5>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#accordion">
                  <div class="accordion-body">
                    Minimum order quantities vary depending on the product type. Please contact us for details.
                  </div>
                </div>
              </div>
              <div class="accordion-item mb-3 wow fadeInUp" data-wow-delay="1.3s">
                <h5 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq6" aria-expanded="false" aria-controls="faq6">
                    05. Which countries do you export to?
                  </button>
                </h5>
                <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#accordion">
                  <div class="accordion-body">
                    We regularly export to Europe, the Middle East, North Africa, and Asian markets.
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
<!-- FAQ Section END -->


<!-- Team Section START -->
<section class="team-section">
    <div class="team-container-wrapper style2 section-padding fix" data-bg-src="assets/images/bg/teamBg2_1.jpg">
        <div class="container">
            <div class="section-title text-center mb-50 mxw-660 mx-auto">
                <div class="subtitle text-center wow fadeInUp" data-wow-delay=".5s">
                    <img class="me-1" src="assets/images/shape/titleShape1_1.png" alt="icon"> Our Products
                    <img class="ms-1" src="assets/images/shape/titleShape1_2.png" alt="icon">
                </div>
                <h2 class="text-center mt-15 wow fadeInUp" data-wow-delay=".3s">
                    Natural Marbles Meeting Quality
                </h2>
            </div>

            <div class="slider-area">
                <div class="swiper gt-slider" id="teamSliderTwo"
                    data-slider-options='{"loop": true,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":1,"centeredSlides":true},"768":{"slidesPerView":2},"992":{"slidesPerView":3},"1200":{"slidesPerView":4}}}'>
                    <div class="swiper-wrapper">
                        <?php
                        $sql = "SELECT urun_id, urun_adi, kategori_id, urun_resim FROM urunler_en ORDER BY urun_id ASC";
                        $result = $conn->query($sql);
                        $delay = 0.3;

                        if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $link = "en-products.php?id=" . $row['urun_id']; 

                                $resimler = json_decode($row['urun_resim'], true);
                                $resim = "";
                                if (is_array($resimler) && count($resimler) > 0) {
                                    $resim = $resimler[0]; 
                                }

                                echo '<div class="swiper-slide">
                                        <div class="team-card style2 wow fadeInUp" data-wow-delay="'.$delay.'s">
                                            <div class="team-thumb">';
                                
                                if (!empty($resim)) {
                                    echo '<img src="/../mermeradmin/uploads/'.htmlspecialchars($resim).'" alt="thumb">';
                                } else {
                                    echo '<img src="assets/images/no-image.png" alt="no image">';
                                }

                                echo '      </div>
                                            <div class="team-content">
                                                <h3><a href="'.htmlspecialchars($link).'">'.htmlspecialchars($row['urun_adi']).'</a></h3>
                                            </div>
                                            <div class="shape1"><img src="assets/images/shape/teamCardShape2_1.png" alt="shape"></div>
                                            <div class="shape2"><img src="assets/images/shape/teamCardShape2_2.png" alt="shape"></div>
                                        </div>
                                      </div>';

                                $delay += 0.2;
                            }
                        } else {
                            echo '<div class="swiper-slide">No products available yet.</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Team Section END -->

<!-- Testimonial Section START -->
<section class="testimonial-section section-padding fix">
  <div class="container">
    <div class="row d-flex align-items-end mb-50">
      <div class="col-xl-6">
        <div class="section-title text-start">
          <div class="subtitle text-start wow fadeInUp" data-wow-delay=".5s">
            <img class="me-1" src="assets/images/shape/titleShape1_1.png" alt="icon">
            CUSTOMER REVIEWS
            <img class="ms-1" src="assets/images/shape/titleShape1_2.png" alt="icon">
          </div>
          <h2 class="text-start mt-15 wow fadeInUp" data-wow-delay=".3s">
            What Our Customers Say About Us
          </h2>
        </div>
      </div>
      <div class="col-xl-6 d-flex justify-content-start justify-content-xl-end mt-4 mt-xl-0">
        <div class="slider-arrow-btn text-end wow fadeInUp" data-wow-delay=".9s">
          <button data-slider-prev="#testimonialSliderTwo" class="slider-arrow style1">
            <i class="fa-solid fa-arrow-left-long"></i>
          </button>
          <button data-slider-next="#testimonialSliderTwo" class="slider-arrow style1 slider-next">
            <i class="fa-solid fa-arrow-right-long"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="testimonial-wrapper style2">
      <div class="row gy-5 d-flex align-items-center">
        <div class="col-xl-6">
          <div class="testimonial-thumb img-custom-anim-left wow fadeInUp" data-wow-delay=".3s">
            <img src="assets/images/intro/4.jpg" alt="thumb">
          </div>
        </div>
        <div class="col-xl-6">
          <div class="slider-area testimonialSliderTwo">
            <div class="swiper gt-slider" id="testimonialSliderTwo"
              data-slider-options='{"loop": true,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":1,"centeredSlides":true},"768":{"slidesPerView":1},"992":{"slidesPerView":1},"1200":{"slidesPerView":1}}}'>
              <div class="swiper-wrapper">

                <div class="swiper-slide">
                  <div class="testimonial-card-items style2 img-custom-anim-top wow fadeInUp" data-wow-delay=".3s">
                    <div class="icon">
                      <img src="assets/images/icon/quoteIcon1_1.svg" alt="icon">
                    </div>
                    <div class="profile-meta">
                      <div class="thumb">
                        <img src="assets/images/testimonial/testimonialProfile2_1.png" alt="thumb">
                      </div>
                      <div class="content">
                        <h6>Ahmet Yılmaz</h6>
                        <p>Contractor</p>
                      </div>
                    </div>
                    <ul class="star-wrapper style1">
                      <li><img src="assets/images/icon/starIcon2_1.svg" alt="icon"></li>
                      <li><img src="assets/images/icon/starIcon2_1.svg" alt="icon"></li>
                      <li><img src="assets/images/icon/starIcon2_1.svg" alt="icon"></li>
                      <li><img src="assets/images/icon/starIcon2_1.svg" alt="icon"></li>
                      <li><img src="assets/images/icon/starIcon2_1.svg" alt="icon"></li>
                    </ul>
                    <div class="body">
                      <p>The product quality and support during the export process exceeded our expectations. Highly recommended.</p>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="testimonial-card-items style2">
                    <div class="icon">
                      <img src="assets/images/icon/quoteIcon1_1.svg" alt="icon">
                    </div>
                    <div class="profile-meta">
                      <div class="thumb">
                        <img src="assets/images/testimonial/testimonialProfile2_1.png" alt="thumb">
                      </div>
                      <div class="content">
                        <h6>Selin Demir</h6>
                        <p>Architect</p>
                      </div>
                    </div>
                    <ul class="star-wrapper style1">
                      <li><img src="assets/images/icon/starIcon2_1.svg" alt="icon"></li>
                      <li><img src="assets/images/icon/starIcon2_1.svg" alt="icon"></li>
                      <li><img src="assets/images/icon/starIcon2_1.svg" alt="icon"></li>
                      <li><img src="assets/images/icon/starIcon2_1.svg" alt="icon"></li>
                      <li><img src="assets/images/icon/starIcon2_2.svg" alt="icon"></li>
                    </ul>
                    <div class="body">
                      <p>The variety is very wide, and export services run smoothly. We always choose them for our projects.</p>
                    </div>
                  </div>
                </div>

                <div class="swiper-slide">
                  <div class="testimonial-card-items style2">
                    <div class="icon">
                      <img src="assets/images/icon/quoteIcon1_1.svg" alt="icon">
                    </div>
                    <div class="profile-meta">
                      <div class="thumb">
                        <img src="assets/images/testimonial/testimonialProfile2_1.png" alt="thumb">
                      </div>
                      <div class="content">
                        <h6>Mehmet Kaya</h6>
                        <p>Exporter</p>
                      </div>
                    </div>
                    <ul class="star-wrapper style1">
                      <li><img src="assets/images/icon/starIcon2_1.svg" alt="icon"></li>
                      <li><img src="assets/images/icon/starIcon2_1.svg" alt="icon"></li>
                      <li><img src="assets/images/icon/starIcon2_1.svg" alt="icon"></li>
                      <li><img src="assets/images/icon/starIcon2_1.svg" alt="icon"></li>
                      <li><img src="assets/images/icon/starIcon2_2.svg" alt="icon"></li>
                    </ul>
                    <div class="body">
                      <p>Our export operations became much easier with fast delivery and high-quality products. Thank you!</p>
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
<!-- Testimonial Section END -->

<!-- Cta Section START -->
<section class="cta-section">
  <div class="cta-container-wrapper style2">
    <div class="container">
      <div class="cta-wrapper style2">
        <div class="shape1">
          <img src="assets/images/shape/ctaShape2_1.png" alt="shape">
        </div>
        <div class="shape2">
          <img src="assets/images/shape/ctaShape2_2.png" alt="shape">
        </div>
        <div class="row gy-5 gy-md-0 d-flex align-items-center">
          <div class="col-xl-4 d-flex justify-content-center">
            <div class="cta-thumb img-custom-anim-left wow fadeInUp" data-wow-delay=".3s">
            </div>
          </div>
          <div class="col-xl-8 d-flex justify-content-center">
            <div class="cta-content">
              <div class="section-title text-start mxw-586">
                <h2 class="text-white text-start mt-15 wow fadeInUp" data-wow-delay=".3s">
                  Delivering Our High-Quality Marble Products Worldwide
                </h2>
                <div class="btn-wrapper style2 img-custom-anim-left wow fadeInUp" data-wow-delay=".3s">
                  <a href="en-about.php" class="theme-btn style2 border mt-4">
                    LEARN MORE ABOUT US
                    <img src="assets/icons/arrow-icon.svg" alt="">
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Cta Section END -->
<?php
$sql = "SELECT baslik, resim FROM galeri ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!-- Gallery Section START -->
<div class="gallery-section fix">
    <div class="gallery-container-wrapper style1" data-bg-src="assets/images/bg/galleryBg2_1.jpg">
        <div class="container">
            <div class="slider-area gallerySliderOne">
                <div class="swiper gt-slider" id="gallerySliderOne"
                    data-slider-options='{"loop": true,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":2,"centeredSlides":true},"768":{"slidesPerView":3},"992":{"slidesPerView":4},"1200":{"slidesPerView":6}}}'>
                    
                    <div class="swiper-wrapper">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <div class="swiper-slide">
                                    <a href="/mermeradmin/uploads/gallery/<?= $row['resim'] ?>" class="img-popup">
                                        <div class="gallery-card style1" data-tilt data-tilt-max="10">
                                            <div class="gallery-thumb">
                                                <img src="/mermeradmin/uploads/gallery/<?= $row['resim'] ?>" 
                                                     alt="<?= htmlspecialchars($row['baslik']) ?>">
                                                <div class="icon">
                                                    <img src="assets/images/icon/galleryIcon1_1.svg" alt="icon">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php
                            }
                        } else {
                            echo "<p style='color:white;text-align:center;'>No gallery images yet.</p>";
                        }
                        ?>
                    </div> <!-- swiper-wrapper -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Gallery Section END -->








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
