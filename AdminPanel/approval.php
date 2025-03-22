<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onay Bekleyen Yorumlar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 10px 20px;
        color: white;
        font-weight: bold;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        z-index: 9999;
    }
    </style>
</head>
<body class="bg-gray-900 text-white">
    <div class="flex h-screen">        
        <?php include('SQLQuery.php'); ?>
        <?php include '../AdminPanel/header.php';?>
        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-3xl font-bold">Onay Bekleyen Yorumlar (<?php echo $approvalWait_comment_count; ?>)</h1>
            <p class="text-gray-400 mt-2">Buradan kullanıcıların gönderdiği yorumları onaylayabilir veya reddedebilirsin.</p>
            <?php
                // connection.php dosyasını dahil et
                include('../connection.php');

                // Yorumları çekmek için SQL sorgusu
                $sql = "SELECT * FROM comment WHERE CommentStatus = 0 ORDER BY CreateDate DESC";
                $result = mysqli_query($con, $sql);

                $approvalWait_comments = []; // Boş bir dizi oluştur

                // Sonuçları diziye aktar
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $approvalWait_comments[] = $row;
                    }
                }

                // Veritabanı bağlantısını kapat
                mysqli_close($con);
            ?>
            <div class="mt-6 space-y-4">
                    <?php foreach ($approvalWait_comments as $comment): ?>
                        <div class="comment bg-gray-800 p-4 rounded-lg flex items-center justify-between">
                            <div class="flex items-center space-x-4"  style="width: 80%;">
                                <img src="..//<?= htmlspecialchars($comment['ProfilPhoto']) ?>" alt="<?= htmlspecialchars($comment['NameSurname']) ?>" width="50" height="50">
                                <div>
                                    <h2 class="text-lg font-semibold"><?= htmlspecialchars($comment['NameSurname']) ?></h2>
                                    <p class="text-gray-400 text-sm break-all"><?= htmlspecialchars($comment['Comment']) ?></p>
                                    <p class="text-gray-500 text-xs mt-1">Gönderim Zamanı: <?= htmlspecialchars($comment['CreateDate']) ?></p>
                                </div>
                            </div>
                            <div class="space-x-2">
                                <button class="bg-green-500 px-3 py-1 rounded hover:bg-green-600 update-status"
                                        data-id="<?= htmlspecialchars($comment['CommentId']) ?>" data-status="1">Onayla</button>

                                <button class="bg-red-500 px-3 py-1 rounded hover:bg-red-600 update-status"
                                        data-id="<?= $comment['CommentId'] ?>" data-status="2">Reddet</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
            </div>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".update-status").click(function () {
                let button = $(this);
                let comment_id = button.data("id");
                let status = button.data("status");

                console.log("Gönderilen ID:", comment_id, "Statü:", status); // Konsolda kontrol et

                $.ajax({
                    url: "updateComment.php",
                    type: "POST",
                    data: { comment_id: comment_id, status: status },
                    success: function (response) {
                        console.log("AJAX Response:", response); // Yanıtı konsolda göster

                        if (response.trim() === "success") {
                            button.closest(".comment-box").fadeOut(500, function () {
                                $(this).remove();
                            });

                            let message = status === 1 ? "Yorum başarıyla onaylandı!" : "Yorum başarıyla reddedildi!";
                            showNotification(message, "success");

                            // **1 saniye sonra sayfayı yenile**
                            setTimeout(function () {
                                location.reload();
                            }, 1000);
                        } else {
                            showNotification("Güncelleme başarısız! Hata: " + response, "error");
                        }
                    },
                    error: function () {
                        showNotification("Bağlantı hatası! Lütfen tekrar deneyin.", "error");
                    }
                });
            });
        });

        function showNotification(message, type) {
            let notification = $("<div></div>")
                .addClass("notification")
                .addClass(type === "success" ? "bg-green-500" : "bg-red-500")
                .text(message)
                .hide()
                .fadeIn(300);

            $("body").append(notification);

            setTimeout(function () {
                notification.fadeOut(500, function () {
                    $(this).remove();
                });
            }, 3000);
        }
    </script>
</body>
</html>
