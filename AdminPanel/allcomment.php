<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tüm Yorumlar</title>
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
<?php include('SQLQuery.php'); ?>
<body class="bg-gray-900 text-white">
    <div class="flex h-screen">
        <?php include '../AdminPanel/header.php';?>
        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-3xl font-bold">Tüm Yorumlar</h1>
            <p class="text-gray-400 mt-2">Buradan onaylanan ve reddedilen yorumları filtreleyerek görebilirsin.</p>
            
            <!-- Filtreleme Butonları -->
            <div class="mt-4 flex space-x-4">
                <button id="show-approved" class="bg-green-500 px-4 py-2 rounded hover:bg-green-600 ">Onaylananlar (<?php echo $approval_comment_count; ?>)</button>
                <button id="show-rejected" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">Reddedilenler (<?php echo $canseled_comment_count; ?>)</button>
            </div>
            
            <!-- Sıralama Seçenekleri -->
            <!-- <div class="mt-4">
                <label for="sort" class="block text-gray-300">Sırala:</label>
                <select id="sort" class="bg-gray-800 text-white p-2 rounded">
                    <option value="date_desc">Tarih (Eskiden Yeniye)</option>
                    <option value="date_asc">Tarih (Yeniden Eskiye)</option>
                    <option value="name_asc">İsme Göre (A-Z)</option>
                    <option value="name_desc">İsme Göre (Z-A)</option>
                </select>
            </div> -->
            <?php
                include('../connection.php'); // Veritabanı bağlantısını dahil et

                // Onaylanmış ve reddedilmiş yorumları getir
                $sql = "SELECT * FROM comment WHERE CommentStatus IN (1, 2) ORDER BY CreateDate DESC";
                $result = mysqli_query($con, $sql);
            ?>
            <!-- Yorum Listesi -->
            <div id="comments-list" class="mt-6 space-y-4">
                <?php while ($comment = mysqli_fetch_assoc($result)): ?>
                    <div class="comment bg-gray-800 p-4 rounded-lg flex items-center justify-between"
                        data-status="<?= $comment['CommentStatus'] ?>" >
                        <div class="flex items-center space-x-4" style="width: 80%;">
                            <img src="../<?= htmlspecialchars($comment['ProfilPhoto']) ?>" alt="Profil Resmi"
                                class="w-12 h-12 rounded-full">
                            <div>
                                <h2 class="text-lg font-semibold"><?= htmlspecialchars($comment['NameSurname']) ?></h2>
                                <p class="text-gray-400 text-sm break-all"><?= htmlspecialchars($comment['Comment']) ?></p>
                                <p class="text-gray-500 text-xs mt-1">Gönderim Tarihi: <?= htmlspecialchars($comment['CreateDate']) ?></p>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <?php if ($comment['CommentStatus'] == 1): ?>
                                <span class="text-green-500 font-bold">Onaylandı</span>
                            <?php else: ?>
                                <span class="text-red-500 font-bold">Reddedildi</span>
                            <?php endif; ?>
                            
                            <!-- Düzenle Butonu -->
                            <button class="update-status bg-gray-500 px-3 py-1 rounded text-black hover:bg-gray-600 hover:text-white"
                                    data-id="<?= $comment['CommentId'] ?>" data-status="0">
                                Düzenle
                            </button>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php mysqli_close($con); ?>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Sayfa Yüklenirken Yalnızca Onaylanmış Yorumları Göster
        document.addEventListener("DOMContentLoaded", function() {
            filterComments("1"); // Sayfa yüklenince onaylanmışları göster
        });

        // Filtreleme İşlemi
        document.getElementById("show-approved").addEventListener("click", function() {
            filterComments("1"); // Onaylıları göster
        });

        document.getElementById("show-rejected").addEventListener("click", function() {
            filterComments("2"); // Reddedilmişleri göster
        });

        function filterComments(status) {
            document.querySelectorAll(".comment").forEach(comment => {
                if (comment.dataset.status === status) {
                    comment.style.display = "flex";
                } else {
                    comment.style.display = "none";
                }
            });
        }

        
        $(".update-status").click(function () {
            let button = $(this);
            let comment_id = button.data("id");

            $.ajax({
                url: "updateComment.php",
                type: "POST",
                data: { comment_id: comment_id, status: 0 },
                success: function (response) {
                    console.log("AJAX Response:", response); 

                    if (response.trim() === "success") {
                        button.closest(".comment").fadeOut(500, function () {
                            $(this).remove(); // Yorumu sayfadan kaldır
                        });

                        // showNotification("Yorum tekrar onaya gönderildi!", "success");
                        let message = status === 1 ? "Yorum tekrar onaya gönderildi!" : "Yorum tekrar onaya gönderildi!";
                        showNotification(message, "success");

                        // **1 saniye sonra sayfayı yenile**
                        setTimeout(function () {
                            location.reload();
                        }, 500);
                    } else {
                        showNotification("Güncelleme başarısız! Hata: " + response, "error");
                    }
                },
                error: function () {
                    showNotification("Bağlantı hatası! Lütfen tekrar deneyin.", "error");
                }
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