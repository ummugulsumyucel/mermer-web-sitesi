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

// Eğer AJAX isteği varsa arama yap
if(isset($_GET['ajax_search'])) {
    $q = $conn->real_escape_string($_GET['q']);
    $sql = "SELECT * FROM urunler_en WHERE urun_adi LIKE '%$q%' LIMIT 10";
    $result = $conn->query($sql);

    if($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $resimler = json_decode($row['urun_resim'], true);
            $ilkResim = !empty($resimler) ? $resimler[0] : '';
            echo '<div class="search-result-item" style="display:flex; align-items:center; padding:5px; border-bottom:1px solid #eee;">';
            echo '<img src="'.($ilkResim ? "/../mermeradmin/uploads/".htmlspecialchars($ilkResim) : "assets/images/no-image.png").'" style="width:50px; height:50px; object-fit:cover; margin-right:10px;">';
            echo '<a href="en-product-detail.php?id='.intval($row['urun_id']).'">'.htmlspecialchars($row['urun_adi']).'</a>';
            echo '</div>';
        }
    } else {
        echo '<div class="search-result-item">Sonuç bulunamadı.</div>';
    }
    exit; // AJAX isteğinde sadece arama sonuçlarını döndür
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
#searchResults {
    position: absolute;
    z-index: 999;
    background: #fff;
    border: 1px solid #ddd;
    max-height: 300px;
    overflow-y: auto;
}
.search-result-item a {
    text-decoration:none; color:#333;
}
.search-result-item a:hover {
    text-decoration:underline;
}
.dropdown-submenu {
    display: none;
    list-style: none;
    padding-left: 15px;
}

.dropdown-submenu.open {
    display: block;
}

.toggle-submenu {
    cursor: pointer;
    margin-left: 5px;
}
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

<!-- Breadcumb Section START -->
<div class="breadcumb-section">
    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-content">
                        <h1 class="breadcumb-title">Our Products</h1>
                        <ul class="breadcumb-menu">
                            <li><a href="en-index.php">Home</a></li>
                            <li class="text-white"><i class="fa-solid fa-chevrons-right"></i></li>
                            <li class="active">Our Products</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shop Section START -->
<div class="shop-section section-padding fix">
    <div class="shop-wrapper style1">
        <div class="container">
            <div class="row gy-5">

                <!-- Products Area -->
                <div class="col-xl-9 col-lg-8 wow fadeInUp" data-wow-delay=".5s">


                    <!-- Products -->
                    <div class="shop-cards-wrapper style3">
                        <div class="row gy-30 gx-30">
                           <?php
        // Sayfalama ayarları
$limit = 12;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// Arama ve kategori filtreleme
$q = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';
$kategori_id = isset($_GET['kategori_id']) ? intval($_GET['kategori_id']) : 0;
$alt_kategori_id = isset($_GET['alt_kategori_id']) ? intval($_GET['alt_kategori_id']) : 0;

// SQL ve toplam ürün sayısı belirleme
if(!empty($q)) {
    $sqlCount = "SELECT COUNT(*) as toplam FROM urunler_en WHERE urun_adi LIKE '%$q%'";
    $sql = "SELECT * FROM urunler_en WHERE urun_adi LIKE '%$q%' LIMIT $offset, $limit";
} elseif($alt_kategori_id > 0) {
    $sqlCount = "SELECT COUNT(*) as toplam FROM urunler_en WHERE alt_kategori_id = $alt_kategori_id";
    $sql = "SELECT * FROM urunler_en WHERE alt_kategori_id = $alt_kategori_id LIMIT $offset, $limit";
} elseif($kategori_id > 0) {
    $sqlCount = "SELECT COUNT(*) as toplam FROM urunler_en 
                 WHERE kategori_id = $kategori_id 
                 OR alt_kategori_id IN (SELECT alt_kategori_id FROM alt_kategoriler_en WHERE kategori_id = $kategori_id)";
    $sql = "SELECT * FROM urunler_en 
            WHERE kategori_id = $kategori_id 
            OR alt_kategori_id IN (SELECT alt_kategori_id FROM alt_kategoriler_en WHERE kategori_id = $kategori_id)
            LIMIT $offset, $limit";
} else {
    $sqlCount = "SELECT COUNT(*) as toplam FROM urunler_en";
    $sql = "SELECT * FROM urunler_en LIMIT $offset, $limit";
}

// Toplam sayfa sayısını hesapla
$totalResult = $conn->query($sqlCount);
$totalRow = $totalResult->fetch_assoc();
$totalUrun = $totalRow['toplam'];
$totalPages = ceil($totalUrun / $limit);

// Ürünleri çek
$result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resimler = json_decode($row['urun_resim'], true);
                $ilkResim = (!empty($resimler) && is_array($resimler)) ? $resimler[0] : "";

                                    echo '
                                    <div class="col-xl-4 col-md-6">
                                        <div class="shop-card-items style2">
                                            <div class="thumb">';
                                    if ($ilkResim != "") {
                                        echo '<img src="/../mermeradmin/uploads/'.htmlspecialchars($ilkResim).'" 
                                                   alt="'.htmlspecialchars($row['urun_adi']).'" 
                                                   style="width:210px; height:190px; object-fit:cover;">';
                                    } else {
                                        echo '<img src="assets/images/no-image.png" 
                                                   alt="No Image" 
                                                   style="width:210px; height:190px; object-fit:cover;">';
                                    }
                                    echo '      </div>
                                            <h3>
                                                <a href="en-product-detail.php?id='.intval($row['urun_id']).'">
                                                    '.htmlspecialchars($row['urun_adi']).'
                                                </a>
                                            </h3>
                                            <div class="btn-wrapper">
                                                <a href="en-product-detail.php?id='.intval($row['urun_id']).'" class="theme-btn style3">
                                                   VIEW PRODUCT DETAILS
                                                </a>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            } else {
                                echo "<p>No products have been added yet or the product you searched for was not found.</p>";
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="page-nav-wrap text-center">
                        <ul>
                            <?php 
                            $kategori_param = isset($kategori_id) && $kategori_id > 0 ? "kategori_id=$kategori_id&" : "";
                            $alt_param = isset($alt_kategori_id) && $alt_kategori_id > 0 ? "alt_kategori_id=$alt_kategori_id&" : "";
                            ?>

                            <?php if($page > 1): ?>
                              <li>
                                <a class="previous" href="?<?= $kategori_param . $alt_param ?>page=<?= $page-1 ?>">
                                    <i class="fa-sharp fa-light fa-arrow-left-long"></i>
                                </a>
                              </li>
                            <?php endif; ?>

                            <?php for($i=1; $i <= $totalPages; $i++): ?>
                              <li>
                                <a class="page-numbers <?= ($i==$page)?'active':''; ?>" href="?<?= $kategori_param . $alt_param ?>page=<?= $i ?>">
                                    <?= $i ?>
                                </a>
                              </li>
                            <?php endfor; ?>

                            <?php if($page < $totalPages): ?>
                              <li>
                                <a class="next" href="?<?= $kategori_param . $alt_param ?>page=<?= $page+1 ?>">
                                    <i class="fa-sharp fa-light fa-arrow-right-long"></i>
                                </a>
                              </li>
                            <?php endif; ?>
                        </ul>
                    </div>

                </div> <!-- /col-xl-9 products end -->

                <!-- Sidebar -->
                <div class="col-xl-3 col-lg-4 wow fadeInUp" data-wow-delay=".3s">
                    <div class="main-sidebar">
                        <div class="single-sidebar-widget">
                            <h5 class="widget-title">Search</h5>
                            <div class="search-widget">
                                <form action="en-products.php" method="get">
                                    <input type="text" id="searchInput" name="q" placeholder="Search" value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
                                    <button><i class="fa-light fa-magnifying-glass"></i></button>
                                </form>
                                <div id="searchResults"></div>
                            </div>
                        </div>
                        <div class="single-sidebar-widget">
                            <h5 class="widget-title">Categories</h5>
                            <ul class="shop-category-list">
                                <?php foreach($kategoriler as $kategori_id => $kategori): ?>
                                    <li class="dropdown-category">
                                        <a href="en-products.php?kategori_id=<?= $kategori_id ?>" class="category-link">
                                            <?= htmlspecialchars($kategori['kategori_adi']); ?>
                                        </a>

                                        <?php if(!empty($kategori['alt_kategoriler'])): ?>
                                        <span class="toggle-submenu"><i class="fa-solid fa-chevron-down"></i></span>
                                        <ul class="dropdown-submenu">
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
                        </div>
                    </div>
                </div> <!-- /col-xl-3 sidebar end -->

            </div>
        </div>
    </div>
</div>
<!-- Shop Section END -->

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
<script>
document.addEventListener("DOMContentLoaded", function () {
    const toggles = document.querySelectorAll(".toggle-submenu");

    toggles.forEach(function(toggle){
        toggle.addEventListener("click", function(e){
            e.preventDefault(); // sayfa gitmesini engelle
            const submenu = this.nextElementSibling; // dropdown-submenu
            if(submenu) submenu.classList.toggle("open");
        });
    });
});
window.addEventListener('load', () => {
    const params = new URLSearchParams(window.location.search);
    if(params.has('kategori_id') || params.has('alt_kategori_id') || params.has('q')) {
        // URL parametrelerini kaldır
        window.history.replaceState({}, document.title, window.location.pathname);
    }
});

</script>
<script src="assets/js/jquery-3.7.1.min.js"></script>
<script>
$('#searchInput').on('input', function() {
    let query = $(this).val().trim();
    if(query.length > 0) {
        $.ajax({
            url: 'en-products.php',
            method: 'GET',
            data: { ajax_search: 1, q: query },
            success: function(data) {
                $('#searchResults').html(data);
            }
        });
    } else {
        $('#searchResults').html('');
    }
});
</script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.waypoints.js"></script>
    <script src="assets/js/jquery.counterup.min.js"></script>
    <script src="assets/js/viewport.jquery.js"></script>
    <script src="assets/js/tilt.min.js"></script>
    <script src="assets/js/jquery.meanmenu.min.js"></script>
    <script src="assets/js/magnific-popup.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/nice-select.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>