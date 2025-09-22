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
            <option value="index2.html">🇹🇷 Türkçe</option>
            <option value="en-index.html">🇬🇧 English</option>
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
</ul>                    </nav>
                        </div>
                    </div>
                </div>
                <div class="header-right d-flex justify-content-end align-items-center">
                    <div class="header-contact-info style2">
                        <div class="icon"> <i class="fa-regular fa-phone" style="color: white;"></i> </div>
                        <div class="content">
                            <h6>Hemen Arayın</h6>
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


    <!-- Breadcumb Section  S T A R T -->
    <div class="breadcumb-section">
        <div class="breadcumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcumb-content">
                            <h1 class="breadcumb-title">Hakkımızda</h1>
                            <ul class="breadcumb-menu">
                                <li><a href="index2.php">Anasayfa</a></li>
                                <li class="text-white"><i class="fa-solid fa-chevrons-right"></i></li>
                                <li class="active">Hakkımızda</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Hakkımızda Bölümü B A Ş L A N G I Ç -->
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
                  HAKKIMIZDA
                </div>
                <h2 class="text-start mt-15 wow fadeInUp" data-wow-delay=".3s">
                  Doğal Taş ve Mermerde <br> Güvenilir Tedarikçi
                </h2>
                <p class="desc wow fadeInUp" data-wow-delay=".5s">
                  Şirketimiz, dünyanın dört bir yanındaki mimari projeler için yüksek kaliteli doğal taş ve mermer ürünleri tedarik eder. Geniş ürün yelpazemiz, sürdürülebilir üretim anlayışımız ve zamanında teslimat güvencemiz ile uluslararası alanda tercih edilen bir iş ortağıyız.
                </p>
              </div>
              <h3>Kalite, estetik ve güvenin birleştiği noktadayız.</h3>
              <div class="row exp-area">
                <div class="col-xl-12">
                  <div class="progress-wrap style2 wow fadeInUp" data-wow-delay=".2s">
                    <div class="progress-meta img-custom-anim-left wow fadeInUp" data-wow-delay=".3s">
                      <div class="title">Uluslararası İhracat Ağı</div>
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
                      <div class="title">Ürün Çeşitliliği & Özelleştirme</div>
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
<!-- Hakkımızda Bölümü B İ T İ Ş -->

  <!-- Firma Tarihçesi Bölümü BAŞLANGIÇ -->
<div class="history-section section-padding fix">
    <div class="container">
        <div class="history-wrapper style1">
            <h2 class="history-title">Firma Tarihçesi</h2>
            <div class="row gy-5 gx-60">
                <div class="col-xl-6">
                    <div class="history-thumb">
                        <img src="assets/images/history/history1_1.jpg" alt="Tarihçe Görseli">
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="history-content">
                        <h2>Küresel Pazarda Güçlü Bir Marka</h2>
                        <p class="text">
                            Firmamız, Türkiye’nin doğal zenginliklerinden biri olan mermeri en yüksek kalite
                            standartlarında işleyerek dünya pazarlarına sunmaktadır. Başta Avrupa, Orta Doğu ve Kuzey
                            Afrika olmak üzere birçok ülkeye gerçekleştirdiğimiz ihracatlarla sektörde güvenilir bir
                            iş ortağı haline geldik.
                            <br><br>
                            Ürün portföyümüzde yer alan özel kesim mermerler, mozaikler ve doğaltaş çeşitleri;
                            projelere estetik, dayanıklılık ve prestij katmak üzere titizlikle hazırlanır. Üretimden
                            sevkiyata kadar her aşamada kalite kontrol süreçlerine önem verir, müşterilerimize zamanında
                            ve eksiksiz teslimat sağlarız.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Firma Tarihçesi Bölümü BİTİŞ -->


  <!-- Müşteri Yorumları Bölümü BAŞLANGIÇ -->
<div class="testimonial-section section-padding pt-0">
    <div class="testimonial-container-wrapper style1">
        <div class="container">
            <div class="row d-flex align-items-end mt-70 mb-60">
                <div class="col-xl-6">
                    <div class="section-title text-start mxw-530">
                        <div class="subtitle text-start wow fadeInUp" data-wow-delay=".5s">
                            <img class="me-1" src="assets/images/shape/titleShape1_1.png" alt="ikon">
                            MÜŞTERİ YORUMLARI
                        </div>
                        <h2 class=" text-start mt-15 wow fadeInUp" data-wow-delay=".3s">
                            Müşterilerimiz Hakkımızda Ne Diyor?
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
                                <div class="shape"><img src="assets/images/shape/testimonialCardShape1_1.png" alt="şekil"></div>
                                <div class="profile-meta">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/testimonialProfile1_1.png" alt="profil">
                                    </div>
                                    <div class="content">
                                        <h6>Ayşe Demir</h6>
                                        <p>Mimar</p>
                                    </div>
                                </div>
                                <div class="body">
                                    <p>Projeme özel kesim mermer siparişi verdim. Hem malzeme kalitesi hem de zamanında teslimat açısından çok memnun kaldım. Kesinlikle tavsiye ederim!</p>
                                    <ul class="star-wrapper style1">
                                        <li><img src="assets/images/icon/starIcon.svg" alt="yıldız"></li>
                                        <li><img src="assets/images/icon/starIcon.svg" alt="yıldız"></li>
                                        <li><img src="assets/images/icon/starIcon.svg" alt="yıldız"></li>
                                        <li><img src="assets/images/icon/starIcon.svg" alt="yıldız"></li>
                                        <li><img src="assets/images/icon/starIcon.svg" alt="yıldız"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="testimonial-card-items style1 wow fadeInUp" data-wow-delay=".7s"
                                data-bg-src="assets/images/bg/testimonialBg1_1.png">
                                <div class="shape"><img src="assets/images/shape/testimonialCardShape1_1.png" alt="şekil"></div>
                                <div class="profile-meta">
                                    <div class="thumb">
                                        <img src="assets/images/testimonial/testimonialProfile1_2.png" alt="profil">
                                    </div>
                                    <div class="content">
                                        <h6>Mehmet Yılmaz</h6>
                                        <p>İnşaat Yöneticisi</p>
                                    </div>
                                </div>
                                <div class="body">
                                    <p>Yurt dışı projelerimiz için doğaltaş tedarik ettik. Firma hem fiyat açısından hem de ihracat prosedürleri konusunda çok profesyonel davrandı.</p>
                                    <ul class="star-wrapper style1">
                                        <li><img src="assets/images/icon/starIcon.svg" alt="yıldız"></li>
                                        <li><img src="assets/images/icon/starIcon.svg" alt="yıldız"></li>
                                        <li><img src="assets/images/icon/starIcon.svg" alt="yıldız"></li>
                                        <li><img src="assets/images/icon/starIcon.svg" alt="yıldız"></li>
                                        <li><img src="assets/images/icon/starIcon.svg" alt="yıldız"></li>
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
<!-- Müşteri Yorumları Bölümü BİTİŞ -->

<!-- Gerçekler ve Rakamlar Bölümü BAŞLANGIÇ -->
<section class="facts-section section-padding pb-0 fix bg-theme2">
    <div class="container">
        <div class="facts-wrapper style1">
            <div class="facts-title">Gerçekler ve Rakamlar</div>
            <div class="row">
                <div class="facts-box-wrapper style1">
                    <div class="facts-box">
                        <h3><span class="counter-number">15</span> <span>+</span></h3>
                        <p class="text">Farklı Ülkeye İhracat</p>
                    </div>
                    <div class="facts-box">
                        <h3><span class="counter-number">50</span> <span>+</span></h3>
                        <p class="text">Farklı Mermer Çeşidi</p>
                    </div>
                    <div class="facts-box">
                        <h3><span class="counter-number">500</span> <span>+</span></h3>
                        <p class="text">Memnun Müşteri</p>
                    </div>
                    <div class="facts-box">
                        <h3><span class="counter-number">1200</span> <span>+</span></h3>
                        <p class="text">Fazla Satış</p>
                    </div>
                    <div class="facts-box">
                        <h3><span class="counter-number">30</span> <span>+</span></h3>
                        <p class="text">Mutlu ve Sadık Müşteri</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Gerçekler ve Rakamlar Bölümü BİTİŞ -->



 <!-- Uzmanlık Alanları B A Ş L A N G I Ç -->
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
                  UZMANLIK
                </div>
                <h2 class="text-start mt-15 wow fadeInUp" data-wow-delay=".3s">
                  Estetik ve Kalitenin <br> Buluştuğu Mermer Ürünleri
                </h2>
                <p class="desc wow fadeInUp" data-wow-delay=".5s">
                  Yüksek kaliteli mermer blok ve plakalarımız; doğal desenleri, dayanıklılığı ve<br> çeşitliliğiyle her projeye uyum sağlar. Yurt içi ve yurt dışında yüzlerce projeye <br>çözüm ortağı olduk.
                </p>
              </div>

              <div class="checklist-wrapper style1">
                <ul class="checklist style2 img-custom-anim-left wow fadeInUp" data-wow-delay=".3s">
                  <li>
                    <img src="assets/icons/icon5.svg" alt="">
                    Yüksek Isı Dayanımı
                  </li>
                  <li>
                    <img src="assets/icons/icon5.svg" alt="">
                    Düşük Bakım İhtiyacı
                  </li>
                </ul>
                <ul class="checklist style2 img-custom-anim-left wow fadeInUp" data-wow-delay=".5s">
                  <li>
                    <img src="assets/icons/icon5.svg" alt="">
                    Doğal Damar Desenleri
                  </li>
                  <li>
                    <img src="assets/icons/icon5.svg" alt="">
                    Premium Kalite Standartları
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
                <img src="assets/images/intro/5.jpg" style="width: 300px; height:  280px;"alt="thumb">
              </div>
              <div class="counter-box style2">
                <div class="counter">
                  <span class="counter-number"> 25 </span> <span>+</span>
                </div>
                <h6>Yıllık Sektör Deneyimi</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Uzmanlık Alanları B İ T İ Ş -->

<!-- Değerler Bölümü BAŞLANGIÇ -->
<section class="values-section section-padding fix">
    <div class="container">
        <div class="values-wrapper style1">
            <div class="values-title">Bizim Değerlerimiz</div>
            <div class="row gy-5">
                <div class="col-xl-6">
                    <div class="values-box style1 wow fadeInUp" data-wow-delay=".3s">
                        <div class="icon">
                            <img src="assets/icons/icon8.svg" alt="Bütünlük">
                        </div>
                        <div class="content">
                            <h3>Bütünlük</h3>
                            <p>İşimizi dürüstlük ve şeffaflıkla yapar, güveninizi her zaman ön planda tutarız.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="values-box style1 wow fadeInUp" data-wow-delay=".5s">
                        <div class="icon">
                            <img src="assets/icons/icon9.svg" alt="Tutku">
                        </div>
                        <div class="content">
                            <h3>Tutku</h3>
                            <p>Mermer ve doğaltaş sektöründe kaliteye ve müşteri memnuniyetine tutkuyla bağlıyız.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="values-box style1 wow fadeInUp" data-wow-delay=".7s">
                        <div class="icon">
                            <img src="assets/icons/icon10.svg" alt="Uyum Sağlama">
                        </div>
                        <div class="content">
                            <h3>Uyum Sağlama</h3>
                            <p>Değişen pazar şartlarına hızlı uyum sağlayarak size en uygun çözümleri sunarız.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="values-box style1 wow fadeInUp" data-wow-delay=".8s">
                        <div class="icon">
                            <img src="assets/icons/icon11.svg" alt="Özen">
                        </div>
                        <div class="content">
                            <h3>Özen</h3>
                            <p>Her ürün ve hizmetimizi özenle hazırlayarak yüksek kalite standartlarımızı koruruz.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Değerler Bölümü BİTİŞ -->

 

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