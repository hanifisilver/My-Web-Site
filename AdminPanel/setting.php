<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ayarlar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    
</head>
<body class="bg-gray-900 text-white">
    <div class="flex h-screen">
        <?php include '../AdminPanel/header.php';?>
        <!-- Main Content -->
        <main class="flex-1 p-6">
            <h1 class="text-3xl font-bold">Ayarlar</h1>
            <p class="text-gray-400 mt-2">Hesap ve sistem ayarlarını buradan güncelleyebilirsin.</p>
            <div id="message" class="text-center mt-2"></div>
            <div class="mt-6 bg-gray-800 p-6 rounded-lg">
                <!-- Şifre Güncelleme -->
                <h2 class="text-xl font-semibold">Şifre Güncelle</h2>
                <form id="passwordUpdateForm" action="update_password.php" method="POST" class="mt-4 space-y-4">
                    <input type="password" name="old_password" placeholder="Eski Şifre" class="w-full p-2 bg-gray-700 text-white rounded" required>
                    <input type="password" name="new_password" placeholder="Yeni Şifre" class="w-full p-2 bg-gray-700 text-white rounded" required>
                    <input type="password" name="confirm_password" placeholder="Yeni Şifre Tekrar" class="w-full p-2 bg-gray-700 text-white rounded" required>
                    <button type="submit" class="bg-blue-500 px-4 py-2 rounded hover:bg-blue-600 update-status">Şifreyi Güncelle</button>
                </form>
            </div>
            <!-- <div class="mt-6 bg-gray-800 p-6 rounded-lg">
                <h2 class="text-xl font-semibold">Dil Seçeneği</h2>
                <select id="language" class="w-full p-2 bg-gray-700 text-white rounded mt-4">
                    <option value="tr">Türkçe</option>
                    <option value="en">İngilizce</option>
                </select>
            </div> -->
            <!-- <div class="mt-6 bg-gray-800 p-6 rounded-lg">
                <h2 class="text-xl font-semibold">Tema Ayarı</h2>
                <div class="mt-4 flex items-center">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox" id="dark-mode-toggle" class="sr-only">
                        <div class="w-12 h-6 bg-gray-500 rounded-full p-1 flex items-center">
                            <div class="w-5 h-5 bg-white rounded-full shadow-md transform transition-transform duration-300"></div>
                        </div>
                        <span class="ml-3 text-gray-300">Koyu Mod</span>
                    </label>
                </div>
            </div> -->
        </main>
    </div>
    <!-- AJAX için jQuery ekleyelim -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#passwordUpdateForm").submit(function(e) {
                e.preventDefault(); // Sayfa yenilenmesini engelle

                $.ajax({
                    type: "POST",
                    url: "update_password.php",
                    data: $(this).serialize(),
                    success: function(response) {
                        console.log("Gelen yanıt:", response); // Yanıtı görmek için

                        if (response.trim() === "success") {
                            $("#message").html("<p class='text-green-500'>✅ Şifre başarıyla güncellendi!</p>").fadeIn();
                            setTimeout(function() {
                                window.location.href = "setting.php"; // Başarıyla yönlendir
                            }, 2000);
                        } else {
                            $("#message").html("<p class='text-red-500'>❌ " + response + "</p>").fadeIn();
                        }
                    },
                    error: function() {
                        $("#message").html("<p class='text-red-500'>⚠️ Bir hata oluştu, lütfen tekrar deneyin.</p>").fadeIn();
                    }
                });
            });
        });
    </script>
</body>
</html>