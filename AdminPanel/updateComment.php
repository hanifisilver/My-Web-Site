<?php
include('../connection.php'); // Veritabanı bağlantısını içe aktar

if (isset($_POST['comment_id']) && isset($_POST['status'])) {
    $comment_id = intval($_POST['comment_id']); // Güvenlik için tam sayıya çevir
    $status = intval($_POST['status']);

    // Yorum statüsünü güncelleme sorgusu
    $sql = "UPDATE comment SET CommentStatus = ? WHERE CommentId = ?";
    $stmt = mysqli_prepare($con, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ii", $status, $comment_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "success";
        } else {
            echo "SQL Error: " . mysqli_error($con); // SQL hatasını göster
        }
    } else {
        echo "Statement Error: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    echo "invalid_request"; // Eğer POST verileri eksikse
}
?>
