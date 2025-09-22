<?php
include 'db.php';

// Kategorileri ve alt kategorileri çek
$sql = "SELECT k.kategori_id, k.kategori_adi, a.alt_kategori_id, a.alt_kategori_adi
        FROM kategoriler k
        LEFT JOIN alt_kategoriler a ON k.kategori_id = a.kategori_id
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
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Gramentheme">
    <meta name="description" content="Florem - Flooring & Tiling Html Template">
    <title>Mermer Tanıtım Sitesi</title>
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
    </style>
</head>
<body>
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>

    <button id="back-top" class="back-to-top">
        <i class="fa-solid fa-chevron-up"></i>
    </button>

  <!-- Offcanvas Alanı Başlangıç -->
<div class="fix-area">
  <div class="offcanvas__info">
    <div class="offcanvas__wrapper">
      <div class="offcanvas__content">
        <!-- Logo ve Kapat Butonu -->
        <div class="offcanvas__top mb-5 d-flex justify-content-between align-items-center">
          <div class="offcanvas__logo">
            <a href="index2.php">
              <img src="assets/images/logo/logo2.svg" alt="logo-img">
            </a>
          </div>
          <div class="offcanvas__close">
            <button><i class="fas fa-times"></i></button>
          </div>
        </div>

        <!-- Tanıtım Yazısı -->
        <p class="text d-none d-xl-block">
        Türkiye'nin kaliteli mermerlerini dünya ile buluşturuyoruz. Sadece satış, yüksek kalite, zamanında teslimat.
        </p>

        <!-- 🌐 Dil Seçici -->
        <div class="language-switcher mb-4">
          <h4>Dil Seçimi</h4>
          <select onchange="location = this.value;" class="form-select mt-2">
            <option value="index2.php">🇹🇷 Türkçe</option>
            <option value="en-index.php">🇬🇧 English</option>
          </select>
        </div>

        <!-- Mobil Menü (Dinamik JavaScript ile dolacak alan) -->
        <div class="mobile-menu fix mb-3"></div>

        <!-- İletişim Bilgileri -->
        <div class="offcanvas__contact">
          <h4>İletişim Bilgileri</h4>
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

          <!-- Teklif Butonu -->
          <div class="header-button mt-4">
            <a href="contact.php" class="theme-btn text-center">
              <span>Teklif Al <i class="fa-solid fa-arrow-right-long"></i></span>
            </a>
          </div>

          <!-- Sosyal Medya İkonları -->
          <div class="social-icon d-flex align-items-center mt-3">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
        <!-- /İletişim Bilgileri -->
      </div>
    </div>
  </div>
</div>
<!-- Kapanma Alanı (overlay) -->
<div class="offcanvas__overlay"></div>
<!-- Offcanvas Alanı Bitiş -->

    <!-- Header Section Start -->
    <header class="header-section-2">
      <div id="header-sticky" class="header-2">
    <div class="container">
        <div class="mega-menu-wrapper">
            <div class="header-main">
                <div class="header-left">
                    <div class="logo">
                        <a href="index2.php" class="header-logo">
                            <img src="assets/images/logo/logo.svg" alt="logo-img">
                        </a>
                    </div>
                </div>
                <div class="header-middle">
                    <div class="mean__menu-wrapper">
                        <div class="main-menu">
                            <nav id="mobile-menu">
                                  <ul>
    <li><a href="index2.php">Ana Sayfa</a></li>
    <li><a href="about.php">Hakkımızda</a></li>

    <li class="has-dropdown">
        <a href="products.php">
            Ürünlerimiz
            <i class="fas fa-angle-down"></i>
        </a>
        <ul class="submenu">
            <?php foreach($kategoriler as $kategori_id => $kategori): ?>
            <li class="has-dropdown">
                <!-- Ana kategori linki -->
                <a href="products.php?kategori_id=<?= $kategori_id ?>">
                    <?= htmlspecialchars($kategori['kategori_adi']); ?>
                </a>

                <?php if(!empty($kategori['alt_kategoriler'])): ?>
                <ul class="submenu">
                    <?php foreach($kategori['alt_kategoriler'] as $alt): ?>
                    <li>
                        <a href="products.php?alt_kategori_id=<?= $alt['alt_kategori_id']; ?>">
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

    <li><a href="gallery.php">Galeri</a></li>
    <li><a href="faq.php">SSS</a></li>
    <li><a href="contact.php">İletişim</a></li>
</ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="header-right d-flex justify-content-end align-items-center">
                    <div class="header-contact-info style2">
                        <div class="icon"> <i class="fa-regular fa-phone" style="color: white;"></i> </div>
                        <div class="content">
                            <h6>Hemen Arayın</h6>
     
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

    <!-- Breadcumb Section  S T A R T -->
    <div class="breadcumb-section">
        <div class="breadcumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcumb-content">
                            <h1 class="breadcumb-title">Sıkça Sorulan Sorular</h1>
                            <ul class="breadcumb-menu">
                                <li><a href="index.php">Anasayfa</a></li>
                                <li class="text-white"><i class="fa-solid fa-chevrons-right"></i></li>
                                <li class="active">SSS</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Faq Section    S T A R T -->
    <section class="faq-section section-padding fix">
        <div class="container">
            <div class="faq-wrapper style1">
                <div class="faq-left">
                    <div class="section-title text-start  mt-70">
                        <div class="subtitle text-start wow fadeInUp" data-wow-delay=".5s"> <img class="me-1"
                                src="assets/images/shape/titleShape1_1.png" alt="icon"> SIKÇA SORULAN SORULAR </div>
                        <h2 class="text-start mt-15 wow fadeInUp" data-wow-delay=".3s">  En Çok Sorulan Sorular </h2>
                        <p class="desc">  Mermer ürünlerimiz ve ihracat süreçlerimiz hakkında en sık karşılaşılan soruları sizler için derledik.</p>
                    </div>
                    <div class="faq-box style1">
                        <div class="header">
                            <div class="icon"> <img src="assets/images/icon/faqIcon1_1.svg" alt="icon"> </div>
                            <h6> <span class="counter-number"> 10 </span> <span class="counter-text"> + </span> Yıllık
                                Deneyim</h6>
                        </div>
                        <p class="text"> Yılların verdiği tecrübe ile kaliteli mermer ürünlerini dünya çapında müşterilerimize sunuyoruz.</p>
                    </div>
                </div>
                <div class="faq-right">
                    <div class="faq-content style1">
                        <div class="faq-accordion">
                            <div class="accordion" id="accordion">
                                <div class="accordion-item mb-3 wow fadeInUp" data-wow-delay=".3s">
                                    <h5 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false"
                                            aria-controls="faq1">
                    01. Hangi çeşit mermer ürünleri sunuyorsunuz?
                  </button>
                </h5>
                <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#accordion">
                  <div class="accordion-body">
                    Beyaz Carrara, Emperador Kahverengi, Traverten, Granit ve daha birçok doğal taş çeşidini ürün portföyümüzde bulabilirsiniz.
                  </div>
                </div>
              </div>
              <div class="accordion-item mb-3 wow fadeInUp" data-wow-delay=".5s">
                <h5 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                    02. İhracat süreçleriniz nasıl işliyor?
                  </button>
                </h5>
                <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordion">
                  <div class="accordion-body">
                    Uluslararası kalite standartlarına uygun paketleme ve lojistik hizmetleri ile dünya çapında ihracat yapmaktayız.
                  </div>
                </div>
              </div>
              <div class="accordion-item mb-3 wow fadeInUp" data-wow-delay=".7s">
                <h5 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                    03. Ürünlerin kalite garantisi var mı?
                  </button>
                </h5>
                <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordion">
                  <div class="accordion-body">
                    Tüm ürünlerimiz kalite kontrolünden geçmekte olup, sağlamlık ve estetik standartlarımız garantilidir.
                  </div>
                </div>
              </div>
              <div class="accordion-item mb-3 wow fadeInUp" data-wow-delay=".9s">
                <h5 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                    04. Minimum sipariş miktarı nedir?
                  </button>
                </h5>
                <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#accordion">
                  <div class="accordion-body">
                    Minimum sipariş miktarları ürün çeşidine göre değişmekle birlikte, detaylar için lütfen bizimle iletişime geçin.
                  </div>
                </div>
              </div>
             <div class="accordion-item mb-3 wow fadeInUp" data-wow-delay="1.3s">
  <h5 class="accordion-header">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
      data-bs-target="#faq6" aria-expanded="false" aria-controls="faq6">
      05. Hangi ülkelere ihracat yapıyorsunuz?
    </button>
  </h5>
  <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#accordion">
    <div class="accordion-body">
      Avrupa, Orta Doğu, Kuzey Afrika ve Asya pazarlarına düzenli olarak ihracat gerçekleştiriyoruz.
    </div>
  </div>
</div>

<div class="accordion-item mb-3 wow fadeInUp" data-wow-delay="1.7s">
  <h5 class="accordion-header">
    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
      data-bs-target="#faq8" aria-expanded="false" aria-controls="faq8">
      06. Ürünlerin teslim süresi ne kadardır?
    </button>
  </h5>
  <div id="faq8" class="accordion-collapse collapse" data-bs-parent="#accordion">
    <div class="accordion-body">
      Sipariş miktarına ve teslimat adresine bağlı olarak genellikle 1-3 hafta arasında teslimat sağlıyoruz.
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
<!-- SSS Bölümü B İ T İ Ş -->


  <!-- Firma Tarihçesi Bölümü BAŞLANGIÇ -->
<div class="history-section section-padding fix">
    <div class="container">
        <div class="history-wrapper style1">
            <h2 class="history-title">İhracat Sürecimiz Nasıl İşliyor?</h2>
           
                <div class="col-xl-12">
                    <div class="history-content">
                        <p class="text" style="text-align: justify;">


                           <b>İhracat Sürecimiz Nasıl İşliyor? </b><br>
Firmamız, mermer ve doğal taş ihracatında profesyonel ve sistematik bir süreç izlemektedir. Siparişten teslimata kadar olan tüm aşamalar, kalite ve müşteri memnuniyeti odaklı yürütülmektedir <br><br>

<b>1. Sipariş Alımı ve Ürün Belirleme </b><br>
Müşterilerimiz, ihtiyaç duyduğu mermer ürünleri (plaka, mozaik, fayans, özel kesim vb.) belirledikten sonra bizimle iletişime geçer. Talep edilen ürün türü, renk, ebat ve miktar detaylandırılır.<br><br>

<b>2. Teklif ve Onay Süreci</b><br>
Müşteriye özel fiyat teklifi hazırlanır. Nakliye yöntemi (FOB, CIF, EXW vb.), teslim süresi ve ödeme koşulları ile birlikte teklif sunulur. Müşterinin onayıyla süreç resmen başlatılır.<br><br>

<b>3. Üretim ve Kalite Kontrol</b><br>
Talep edilen ürünler titizlikle hazırlanır. Üretim süreci boyunca kalite kontrol ekiplerimiz ürünleri inceler ve standartlara uygunluğunu teyit eder.<br><br>

<b>4. Paketleme ve Yükleme</b><br>
Ürünler, ihracat için uygun ambalajlama kurallarına göre paketlenir. Kırılma, çizilme gibi risklere karşı özel korumalar uygulanır. Ardından konteynerlere yüklenerek sevkiyata hazır hale getirilir.<br><br>

<b>5. Gümrük ve Evrak İşlemleri</b><br>
İhracat belgeleri (fatura, çeki listesi, menşe şahadetnamesi, sağlık sertifikası vb.) hazırlanır. Gümrük işlemleri uzman kadromuz tarafından yürütülür.<br><br>

<b>6. Nakliye ve Teslimat</b><br>
Ürünler, anlaşmalı lojistik firmaları aracılığıyla kara, deniz veya hava yoluyla müşteriye ulaştırılır. Teslim süreci boyunca müşteriye düzenli bilgi verilir.<br><br>

<b>7. Satış Sonrası Destek</b> <br>
Teslimat sonrası müşteri memnuniyeti takip edilir. Her türlü soru ve talep için destek sağlanır.<br><br>
                         
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Firma Tarihçesi Bölümü BİTİŞ -->

 <!-- Footer Section    S T A R T -->
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
                  <h6>Adres</h6>
                  <p>Karasu / Sakarya</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 d-flex justify-content-start justify-content-lg-end">
              <div class="fancy-box">
                <div class="item1"><i class="fa-solid fa-envelope"></i></div>
                <div class="item2">
                  <h6>E-Posta</h6>
                  <p>info@mermersitesi.com</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 d-flex justify-content-start justify-content-lg-end">
              <div class="fancy-box">
                <div class="item1"><i class="fa-regular fa-phone-volume"></i></div>
                <div class="item2">
                  <h6>Telefon</h6>
                  <p> 0 (123) 456 45 66</p>
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
              <a href="index2.php">
                <img src="assets/images/logo/logo4.svg" alt="logo-img">
              </a>
            </div>
            <div class="footer-content">
              <p>
                Türkiye'nin kaliteli mermerlerini dünya ile buluşturuyoruz. Sadece satış, yüksek kalite, zamanında teslimat.
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
                <img class="me-1" src="assets/images/shape/footertitleShape1_1.png" alt="shape"> Hızlı Erişim
              </h3>
            </div>
            <ul class="list-area">
              <li><a href="index2.php"><i class="fa-solid fa-chevron-right"></i> Anasayfa</a></li>
              <li><a href="products.php"><i class="fa-solid fa-chevron-right"></i> Ürünler</a></li>
              <li><a href="about.php"><i class="fa-solid fa-chevron-right"></i> Hakkımızda</a></li>
              <li><a href="faq.php"><i class="fa-solid fa-chevron-right"></i> Sık Sorulan Sorular</a></li>
              <li><a href="contact.php"><i class="fa-solid fa-chevron-right"></i> İletişim</a></li>
            </ul>
          </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".6s">
          <div class="single-footer-widget">
            <div class="widget-head">
              <h3>
                <img class="me-1" src="assets/images/shape/footertitleShape1_1.png" alt="shape"> Ürün Grupları
              </h3>
            </div>
            <ul class="list-area">
              <?php foreach($kategoriler as $kategori_id => $kategori): ?>
            <li class="has-dropdown">
                <!-- Ana kategori linki -->
                <a href="products.php?kategori_id=<?= $kategori_id ?>">
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
          © 2025 Tüm Hakları Saklıdır 
        </p>
        <ul class="brand-logo wow fadeInRight" data-wow-delay=".5s">
          <li><a class="text-white" href="#">Gizlilik Politikası</a></li>
          <li><a class="text-white" href="#">Kullanım Şartları</a></li>
          <li><a class="text-white" href="contact.php">İletişim</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>
<!-- Footer Section    E N D -->

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