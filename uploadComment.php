<?php 
   session_start(); // Oturumu başlat
   ob_start(); // Header hatası önlemek için çıktıyı buffer'a al

	// include("connection.php");

    // Veritabanı bağlantısı
    $conn = new mysqli("localhost", "root", "", "hanifigumusDB");

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // Kullanıcıdan gelen veriler
    $CommentStatus = 0;
    $name = $_POST['name'];
    $job = $_POST['job'];
    $comment = $_POST['comment'];
    $createdAt = date("Y-m-d H:i:s");

    // Profil resmini kaydetme
    $uploadDir = "Uploads/"; // Resimlerin kaydedileceği klasör
    $uploadFile = $uploadDir . basename($_FILES["profile_image"]["name"]);

    // Dosya uzantısını kontrol et (sadece JPG, PNG, JPEG izin veriyoruz)
    $allowedExtensions = array("jpg", "jpeg", "png", "webp", "heic", "heif");
    $fileExtension = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    if ($fileExtension == "heic" || $fileExtension == "heif") {
        $im = new Imagick($fileTmpPath);
        $im->setImageFormat("jpeg"); // JPG formatına dönüştür
        $newFilePath = $uploadDir . pathinfo($fileName, PATHINFO_FILENAME) . ".jpg";
        $im->writeImage($newFilePath);
        $im->destroy();
    }

    // if (!in_array($fileExtension, $allowedExtensions)) {
    //     die("Sadece JPG, JPEG ve PNG dosyalarına izin verilmektedir.");
    // }

    // Dosyayı sunucuya yükleme
    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $uploadFile)) {
        // Verileri veritabanına ekleme
        $sql = "INSERT INTO comment (CommentStatus, NameSurname, JobTitle, Comment, CreateDate, ProfilPhoto) 
                VALUES ('$CommentStatus', '$name', '$job', '$comment', '$createdAt', '$uploadFile')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Yorum başarıyla eklendi!";
            header("Location: index.php?comment_success=1");
            exit();
        } else {
            echo "Hata: " . $conn->error;
            header("Location: index.php?comment_error=1");
        exit();
        }
    } else {
        echo "Dosya yüklenirken bir hata oluştu.";
        header("Location: index.php?comment_error=1");
        exit();
    }

    // Bağlantıyı kapat
    $conn->close();
?>