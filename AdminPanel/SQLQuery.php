<?php
    // connection.php dosyasını dahil et
    include('../connection.php');

    // Yorum sayısını almak için SQL sorgusu
    $sql = "SELECT COUNT(*) AS comment_count FROM comment";
    $result = mysqli_query($con, $sql);

    // Sonuçları kontrol et ve değerini al
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $commentCount = $row['comment_count'];
    } else {
        $commentCount = 0; // Eğer hata olursa 0 değeri ver
    }

    // Veritabanı bağlantısını kapat
    mysqli_close($con);
?>

<?php
    // connection.php dosyasını dahil et
    include('../connection.php');

    // Yorum sayısını almak için SQL sorgusu
    $sql = "SELECT COUNT(*) AS approval_comment_count FROM comment WHERE CommentStatus = 1";
    $result = mysqli_query($con, $sql);

    // Sonuçları kontrol et ve değerini al
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $approval_comment_count = $row['approval_comment_count'];
    } else {
        $approval_comment_count = 0; // Eğer hata olursa 0 değeri ver
    }

    // Veritabanı bağlantısını kapat
    mysqli_close($con);
?>
<?php
    // connection.php dosyasını dahil et
    include('../connection.php');

    // Yorum sayısını almak için SQL sorgusu
    $sql = "SELECT COUNT(*) AS canseled_comment_count FROM comment WHERE CommentStatus = 2";
    $result = mysqli_query($con, $sql);

    // Sonuçları kontrol et ve değerini al
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $canseled_comment_count = $row['canseled_comment_count'];
    } else {
        $canseled_comment_count = 0; // Eğer hata olursa 0 değeri ver
    }

    // Veritabanı bağlantısını kapat
    mysqli_close($con);
?>
<?php
    // connection.php dosyasını dahil et
    include('../connection.php');

    // Yorum sayısını almak için SQL sorgusu
    $sql = "SELECT COUNT(*) AS approvalWait_comment_count FROM comment WHERE CommentStatus = 0";
    $result = mysqli_query($con, $sql);

    // Sonuçları kontrol et ve değerini al
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $approvalWait_comment_count = $row['approvalWait_comment_count'];
    } else {
        $approvalWait_comment_count = 0; // Eğer hata olursa 0 değeri ver
    }

    // Veritabanı bağlantısını kapat
    mysqli_close($con);
?>
