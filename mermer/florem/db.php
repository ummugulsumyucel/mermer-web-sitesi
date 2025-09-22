<?php
// Veritabanı bilgileri
$servername = "localhost";
$username   = "root";       // MySQL kullanıcı adı
$password   = "";           // MySQL şifresi
$dbname     = "mermer_panel";   // Veritabanı adı

// Bağlantıyı oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// UTF-8 karakter desteği
$conn->set_charset("utf8mb4");
?>
