<?php
session_start();
include('../connection.php'); // Veritabanı bağlantısı

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['AdminID'])) {
        echo "Yetkisiz erişim!";
        exit();
    }

    $AdminID = $_SESSION['AdminID'];
    $OldPassword = $_POST['old_password'];
    $NewPassword = $_POST['new_password'];
    $ConfirmPassword = $_POST['confirm_password'];

    // Şifrelerin eşleştiğini kontrol et
    if ($NewPassword !== $ConfirmPassword) {
        echo "Şifreler uyuşmuyor!";
        exit();
    }

    // Mevcut şifreyi veritabanından çek
    $sql = "SELECT Password FROM adminuser WHERE AdminID = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $AdminID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $DbPassword);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Eski şifreyi doğrula
    if (!password_verify($OldPassword, $DbPassword)) {
        echo "Mevcut şifre yanlış!";
        exit();
    }

    // Yeni şifreyi hash'le
    $HashedPassword = password_hash($NewPassword, PASSWORD_BCRYPT);

    // Şifreyi güncelleme sorgusu
    $sql = "UPDATE adminuser SET Password = ? WHERE AdminID = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "si", $HashedPassword, $AdminID);

    if (mysqli_stmt_execute($stmt)) {
        echo "success"; // Şifre başarıyla güncellendi
    } else {
        echo "Hata: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    echo "Geçersiz istek!";
}
?>