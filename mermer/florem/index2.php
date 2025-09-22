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

$sql = "SELECT baslik, resim FROM galeri ORDER BY id DESC"; 
$result = $conn->query($sql);



?>
    
    <!DOCTYPE html>
    <html lang="TR">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Gramentheme">
    <meta name="description" content="Florem - Flooring & Tiling Html Template">
    <title>Mermer | </title>
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
                <div class="intro-wrapper style1 fix  section-padding bg-img">
                    <div class="shape"><img src="assets/images/shape/heroShape1_1.png" alt="shape"></div>
                    <div class="gt-hero-bg" data-bg-src="assets/images/bg/introBg1_1.jpg"></div>
                    <div class="container">
                        <div class="intro-content-wrapper style1" data-animation="slideInLeft"
                            data-duration="2s" data-delay="0.3s">
                            <div class="row gy-5 d-flex align-items-center">
                                <div class="col-xl-6">
                                    <div class="intro-content">
                                        <div class="section-title text-start  mt-70">
                                            <div class="subtitle text-start" data-ani="slideindown"
                                                data-ani-delay="0.3s"> <img class="me-1"
                                                    src="assets/images/shape/titleShape1_1.png" alt="icon"> Doğal Taş ve Mermerde Global Çözümler</div>
                                            <h1 class="text-start mt-15" data-ani="slideindown"
                                                data-ani-delay="0.5s"> Projelerinize Değer Katacak  <br> Doğal Taş Çözümleri</h1>
                                            <p class="desc" data-ani="slideinup" data-ani-delay="0.8s"> Her türden yüksek kaliteli mermer ve 
                                                doğal taş ürünlerimizle, iç ve dış mekan projelerinize estetik ve dayanıklılık sunuyoruz. 
                                                Güvenilir ihracat çözümlerimizle dünyanın her yerine ulaşıyoruz.</p>
                                        </div>
                                        <div class="btn-wrapper style2" data-ani="slideinup"
                                            data-ani-delay="1s">
                                            <a href="contact.php" class="theme-btn style3">
                                               DAHA FAZLASI 
                                              <img src="assets/icons/arrow-icon.svg" alt="Yön Ok İkonu" width="41" height="26">
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


<!-- Ürün Kategorileri Bölümü B A Ş L A N G I Ç -->
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
                ÜRÜN KATEGORİLERİ
              </div>
              <h2 class="text-start mt-15 wow fadeInUp" data-wow-delay=".3s">
                Her Projeye Uygun <br> Mermer Ürünleri
              </h2>
            </div>
          </div>
          <div class="col-xl-6 d-flex justify-content-start justify-content-xl-end mt-4 mt-xl-0">
            <div class="btn-wrapper style2">
              <a href="products.php" class="theme-btn style2">
                TÜM ÜRÜNLERİ GÖR
                <img src="assets/icons/arrow-icon.svg" alt="Yön Ok İkonu" width="41" height="26">
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
              <h3><a href="product-details.php">Endüstriyel Mermer Satışı</a></h3>
              <p class="text">Fabrika, AVM ve büyük ölçekli projeler için toplu mermer tedariki.</p>
              <div class="icon">
                <img src="assets/icons/icon1.svg" alt="Kategori İkonu">
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="service-card style2 background-image" data-tilt data-tilt-max="15">
            <div class="content">
              <div class="number">02</div>
              <h3><a href="product-details.php">Zemin ve Duvar Mermeri</a></h3>
              <p class="text">İç ve dış mekanlar için uygun ebatlarda doğal taş ürünleri.</p>
              <div class="icon">
                <img src="assets/icons/icon2.svg" alt="Kategori İkonu">
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="service-card style2 background-image" data-tilt data-tilt-max="10">
            <div class="content">
              <div class="number">03</div>
              <h3><a href="product-details.php">Dekoratif Mermer Çeşitleri</a></h3>
              <p class="text">Mutfak, banyo, merdiven ve iç dekorasyon için özel mermer seçenekleri.</p>
              <div class="icon">
                <img src="assets/icons/icon3.svg" alt="Kategori İkonu">
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-md-6">
          <div class="service-card style2 background-image" data-tilt data-tilt-max="12">
            <div class="content">
              <div class="number">04</div>
              <h3><a href="product-details.php">İhracat & Lojistik</a></h3>
              <p class="text">Dünya genelindeki müşteriler için paketleme ve sevkiyat süreci.</p>
              <div class="icon">
                <img src="assets/icons/icon4.svg" alt="Kategori İkonu">
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
<!-- Ürün Kategorileri Bölümü B İ T İ Ş -->

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
              <div class="btn-wrapper style2 wow fadeInUp" data-wow-delay=".5s">
                <a href="about.php" class="theme-btn style3">
                  DAHA FAZLA KEŞFET
                  <img src="assets/icons/arrow-icon.svg" alt="Ok İkonu">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Hakkımızda Bölümü B İ T İ Ş -->


 <!-- Uzmanlık Alanları B A Ş L A N G I Ç -->
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
                  UZMANLIK
                </div>
                <h2 class="text-start mt-15 wow fadeInUp" data-wow-delay=".3s">
                  Estetik ve Kalitenin <br> Buluştuğu Mermer Ürünleri
                </h2>
                <p class="desc wow fadeInUp" data-wow-delay=".5s">
                  Yüksek kaliteli mermer blok ve plakalarımız; doğal desenleri, dayanıklılığı ve çeşitliliğiyle <br>her projeye uyum sağlar. Yurt içi ve yurt dışında yüzlerce projeye çözüm ortağı olduk.
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
                <img src="assets/images/intro/7.jpg" alt="thumb" style="width: 300px; height: 340px;">
              </div>
              <div class="counter-box style2">
                <div class="counter">
                  <span class="counter-number"> 10 </span> <span>+</span>
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

<!-- SSS Bölümü B A Ş L A N G I Ç -->
<section class="faq-section section-padding pt-0 fix">
  <div class="container">
    <div class="faq-wrapper style1">
      <div class="faq-left">
        <div class="section-title text-start mt-70">
          <div class="subtitle text-start wow fadeInUp" data-wow-delay=".5s">
            <img class="me-1" src="assets/images/shape/titleShape1_1.png" alt="icon"> SIKÇA SORULAN SORULAR
          </div>
          <h2 class="text-start mt-15 wow fadeInUp" data-wow-delay=".7s">
            En Çok Sorulan Sorular
          </h2>
          <p class="desc wow fadeInUp" data-wow-delay=".9s">
            Mermer ürünlerimiz ve ihracat süreçlerimiz hakkında en sık karşılaşılan soruları sizler için derledik.
          </p>
        </div>
        <div class="faq-box style1 img-custom-anim-left wow fadeInUp" data-wow-delay=".3s">
          <div class="header">
            <div class="icon">
              <img src="assets/images/icon/faqIcon1_1.svg" alt="icon">
            </div>
            <h6>
              <span class="counter-number"> 10 </span>+
              <span class="counter-text"> Yıllık </span> Deneyim
            </h6>
          </div>
          <p class="text">
            Yılların verdiği tecrübe ile kaliteli mermer ürünlerini dünya çapında müşterilerimize sunuyoruz.
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
            </div>
          </div>
        </div>
      </div>      
    </div>
  </div>
</section>
<!-- SSS Bölümü B İ T İ Ş -->

    <!-- Team Section    S T A R T -->
    <section class="team-section">
    <div class="team-container-wrapper style2 section-padding fix" data-bg-src="assets/images/bg/teamBg2_1.jpg">
    <div class="container">
        <div class="section-title text-center mb-50 mxw-660 mx-auto">
            <div class="subtitle text-center wow fadeInUp" data-wow-delay=".5s"> <img class="me-1"
                    src="assets/images/shape/titleShape1_1.png" alt="icon"> Ürünlerimiz<img class="ms-1"
                    src="assets/images/shape/titleShape1_2.png" alt="icon"> </div>
            <h2 class="text-center mt-15 wow fadeInUp" data-wow-delay=".3s"> Kaliteyle Buluşan Doğal Mermerler
            </h2>
        </div>

        <div class="slider-area">
            <div class="swiper gt-slider" id="teamSliderTwo"
                data-slider-options='{"loop": true,"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":1,"centeredSlides":true},"768":{"slidesPerView":2},"992":{"slidesPerView":3},"1200":{"slidesPerView":4}}}'>
<div class="swiper-wrapper">
<?php
$sql = "SELECT urun_id, urun_adi, kategori_id, urun_resim FROM urunler ORDER BY urun_id ASC";
$result = $conn->query($sql);
$delay = 0.3;

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $link = "products.php?id=" . $row['urun_id']; // ID bazlı link

        // JSON stringi diziye çeviriyoruz
        $resimler = json_decode($row['urun_resim'], true);

        // Eğer resimler varsa ilkini al
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
            echo '<img src="assets/images/no-image.png" alt="no image">'; // yedek resim
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
    echo '<div class="swiper-slide">Henüz ürün yok.</div>';
}
?>

</div>


            </div>

        </div>
    </div>
    </div>
    </section>

 <!-- Testimonial Section    S T A R T -->
<section class="testimonial-section section-padding fix">
  <div class="container">
    <div class="row d-flex align-items-end mb-50">
      <div class="col-xl-6">
        <div class="section-title text-start">
          <div class="subtitle text-start wow fadeInUp" data-wow-delay=".5s">
            <img class="me-1" src="assets/images/shape/titleShape1_1.png" alt="icon">
            MÜŞTERİ YORUMLARI
            <img class="ms-1" src="assets/images/shape/titleShape1_2.png" alt="icon">
          </div>
          <h2 class="text-start mt-15 wow fadeInUp" data-wow-delay=".3s">
            Müşterilerimiz Bizim Hakkımızda Ne Diyor?
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
                        <p>Müteahhit</p>
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
                      <p>Ürün kalitesi ve ihracat sürecindeki destekleri beklentilerimizin çok üzerindeydi. Kesinlikle tavsiye ederim.</p>
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
                        <p>Mimar</p>
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
                      <p>Çeşitler çok geniş ve ihracat hizmetleri sorunsuz işliyor. Projelerimizde mutlaka tercih ediyoruz.</p>
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
                        <p>İhracatçı</p>
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
                      <p>Hızlı teslimat ve kaliteli ürünlerle ihracat işlerimiz çok kolaylaştı. Teşekkürler!</p>
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
<!-- Testimonial Section    E N D -->

<!-- Cta Section    S T A R T -->
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
                  Kaliteli Mermer Ürünlerimizi Tüm Dünyaya Ulaştırıyoruz
                </h2>
                <div class="btn-wrapper style2 img-custom-anim-left wow fadeInUp" data-wow-delay=".3s">
                  <a href="about.php" class="theme-btn style2 border mt-4">
                    HAKKIMIZDA DAHA FAZLA
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
<!-- Cta Section    E N D -->


<?php
$sql = "SELECT baslik, resim FROM galeri ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!-- Gallery Section    S T A R T -->
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
                            echo "<p style='color:white;text-align:center;'>Henüz galeri resmi yok.</p>";
                        }
                        ?>
                    </div> <!-- swiper-wrapper -->
                </div>
            </div>
        </div>
    </div>
</div>

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
    </html>