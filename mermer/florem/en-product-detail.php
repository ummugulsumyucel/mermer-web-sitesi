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

// Ürün id'sini GET ile alıyoruz
$urun_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ürün bilgilerini veritabanından çek
$sql = "SELECT * FROM urunler_en WHERE urun_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $urun_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Ürün adı artık $row['urun_adi'] ile kullanılabilir
     // Resimleri JSON'dan array'e çevir
    $resimler = json_decode($row['urun_resim'], true);

    // İlk resmi al
    $ilkResim = !empty($resimler) ? $resimler[0] : 'no-image.png';
} else {
    echo "Ürün bulunamadı!";
    exit;
}


// Form mesajını tutacak değişken
$message = '';

// Form gönderildiyse
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $isim = $conn->real_escape_string($_POST['isim']);
    $email = $conn->real_escape_string($_POST['email']);
    $telefon = isset($_POST['telefon']) ? $conn->real_escape_string($_POST['telefon']) : '';
    $konu = $conn->real_escape_string($_POST['konu']);
    $mesaj = $conn->real_escape_string($_POST['mesaj']);

    $sql = "INSERT INTO iletisim (isim, email, telefon, konu, mesaj) 
            VALUES ('$isim', '$email', '$telefon', '$konu', '$mesaj')";

    if($conn->query($sql)) {
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

<!-- Breadcumb Section START -->
<div class="breadcumb-section">
    <div class="breadcumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-content">
                        <h1 class="breadcumb-title">Product Details</h1>
                        <ul class="breadcumb-menu">
                            <li><a href="en-index.html">Home</a></li>
                            <li class="text-white"><i class="fa-solid fa-chevrons-right"></i></li>
                            <li class="active">Product Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shop Details Section START -->
<div class="shop-details-section section-padding fix">
    <div class="shop-details-wrapper style1">
        <div class="container">
            <div class="shop-details bg-white">
                <div class="container">
                    <div class="row gx-60">
                        <div class="col-lg-6">
                            <div class="product-big-img bg-color2">
                                <div class="product-thumb">
                                    <img src="/../mermeradmin/uploads/<?= htmlspecialchars($ilkResim); ?>" 
                                         alt="<?= htmlspecialchars($row['urun_adi']); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-about">
                                <div class="title-wrapper">
                                    <h2 class="product-title">
                                        <?= htmlspecialchars($row['urun_adi']); ?>
                                    </h2>
                                </div>
                                <p class="text"><?= htmlspecialchars($row['aciklama']); ?></p>
                                <div class="share">
                                    <h6>Share with Friends</h6>
                                    <ul class="social-media">
                                        <li> <a href="https://www.facebook.com"> <i class="fa-brands fa-facebook-f"></i> </a> </li>
                                        <li> <a href="https://www.youtube.com"> <i class="fa-brands fa-youtube"></i> </a> </li>
                                        <li> <a href="https://www.x.com"> <i class="fa-brands fa-twitter"></i> </a> </li>
                                        <li> <a href="https://www.instagram.com"> <i class="fa-brands fa-instagram"></i> </a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
 <?php
// 1. İngilizce nitelik isimlerini çek
$nitelikler_sql = "SELECT nitelik_id, nitelik_adi FROM nitelikler_en";
$nitelikler_result = $conn->query($nitelikler_sql);
$nitelik_isimleri = [];
while($nitelik = $nitelikler_result->fetch_assoc()) {
    $nitelik_isimleri[$nitelik['nitelik_id']] = $nitelik['nitelik_adi'];
}

try {
    // 2. Ürünün nitelik JSON verisini al
    $nitelikler_data = isset($row['nitelikler']) ? $row['nitelikler'] : '[]';
    $urun_nitelikleri = json_decode($nitelikler_data, true) ?: [];
    $nitelik_display = [];

    if(is_array($urun_nitelikleri)) {
        foreach($urun_nitelikleri as $nitelik_id => $deger) {
            if (!empty($deger)) {
                // Eğer id ise (örn: "1") tabloya bak
                if (isset($nitelik_isimleri[$nitelik_id])) {
                    $adi = $nitelik_isimleri[$nitelik_id];
                } else {
                    // Yoksa key doğrudan isimdir (örn: "Color")
                    $adi = $nitelik_id;
                }
                $nitelik_display[$adi] = $deger;
            }
        }
    }

    // 3. Başlık ve şık HTML kutucuklarla göster
    echo "<h3 style='color:#34495e; margin-bottom:10px; margin-top:10px;'>Product Attributes</h3>";

    if(!empty($nitelik_display)) {
        echo "<div style='display: flex; flex-wrap: wrap; gap: 12px;'>";
        foreach($nitelik_display as $adi => $deger) {
            echo "<div style='border:1px solid #bdc3c7; border-radius:8px; padding:12px 15px; min-width:140px; background:#ecf0f1; box-shadow: 1px 1px 5px rgba(0,0,0,0.05);'>";
            echo "<strong style='color:#2c3e50; display:block; margin-bottom:4px;'>".htmlspecialchars($adi)."</strong>";
            echo "<span style='color:#4c7b65;'>".htmlspecialchars($deger)."</span>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<p>No attributes found for this product.</p>";
    }

} catch(Exception $e) {
    echo "<p>No attributes found for this product.</p>";
}
?>


                            <!-- Contact Form -->
                            <div class="comment-form">
                                <div class="form-title">
                                    <h3 class="inner-title">Contact</h3>
                                    <p style="margin: 10px;">Your privacy is important to us. Required fields are marked with *.</p>
                                </div>
                                
                                <?php echo $message; ?>
                                
                                <form method="POST" action="">
                                    <div class="row">
                                        <div class="col-md-6 form-group style-white2">
                                            <input type="text" name="isim" placeholder="Your Name *" class="form-control" required>
                                            <i class="text-title far fa-user"></i>
                                        </div>
                                        <div class="col-md-6 form-group style-white2">
                                            <input type="email" name="email" placeholder="Your Email *" class="form-control" required>
                                            <i class="text-title far fa-envelope"></i>
                                        </div>
                                        <div class="col-md-6 form-group style-white2">
                                            <input type="tel" name="telefon" placeholder="Phone (optional)" class="form-control">
                                            <i class="text-title far fa-phone"></i>
                                        </div>
                                        <div class="col-md-6 form-group style-white2">
                                            <input type="text" name="konu" placeholder="Subject *" class="form-control" required>
                                            <i class="text-title far fa-file-alt"></i>
                                        </div>
                                        <div class="col-12 form-group style-white2">
                                            <textarea name="mesaj" placeholder="Write your message *" class="form-control" rows="5" required></textarea>
                                            <i class="text-title far fa-pencil-alt"></i>
                                        </div>

                                        <div class="col-12 form-group mb-0">
                                            <button type="submit" name="submit" class="btn-wrapper theme-btn style3" style="max-width: 300px;">SEND</button>
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- /comment-form -->

                        </div>
                    </div> <!-- /row -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Details Section END -->
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
</body>
</html>
