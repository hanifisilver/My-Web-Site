<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneli</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <?php include('SQLQuery.php'); ?>
    <?php
        session_start();
        $_SESSION['login_time'] = time(); // Giriş yapılan zamanı kaydet
        $_SESSION['expire_time'] = 3600; // 1 saat (3600 saniye)
        //  echo $_SESSION['AdminID'];
        include("..//connection.php");
        include("..//ClassLibrary//function.php");

        $user_data = check_login($con);

        if (isset($_SESSION['login_time']) && (time() - $_SESSION['login_time'] > $_SESSION['expire_time'])) {
            session_unset();
            session_destroy();
            header("Location: login.php?session_expired=true"); // Login sayfasına yönlendir
            exit();
        }
    ?>
</head>
<body class="bg-gray-900 text-white">
    <div class="flex h-screen">
        <?php include '../AdminPanel/header.php';?>
        <!-- Main Content -->
        <main class="flex-1 p-6 mt-5">
            <h1 class="text-3xl font-bold mt-5">Hoş Geldin, Admin!</h1>
            <p class="text-gray-400 mt-2">Buradan yorumları yönetebilir ve ayarları düzenleyebilirsin.</p>
            
            <!-- Dashboard (Yorum İstatistikleri) -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gray-800 p-6 rounded-lg shadow-md text-center">
                    <h2 class="text-xl font-semibold">Toplam Yorum</h2>
                    <p class="text-3xl font-bold mt-2"><?php echo $commentCount; ?></p>
                </div>
                <div class="bg-green-700 p-6 rounded-lg shadow-md text-center">
                    <h2 class="text-xl font-semibold">Onaylanmış Yorumlar</h2>
                    <p class="text-3xl font-bold mt-2"><?php echo $approval_comment_count; ?></p>
                </div>
                <div class="bg-red-700 p-6 rounded-lg shadow-md text-center">
                    <h2 class="text-xl font-semibold">Reddedilmiş Yorumlar</h2>
                    <p class="text-3xl font-bold mt-2"><?php echo $canseled_comment_count; ?></p>
                </div>
                <div class="bg-yellow-600 p-6 rounded-lg shadow-md text-center col-span-1 md:col-span-3">
                    <h2 class="text-xl font-semibold">Onay Bekleyen Yorumlar</h2>
                    <p class="text-3xl font-bold mt-2"><?php echo $approvalWait_comment_count; ?></p>
                </div>
            </div>
        </main>
    </div>    
</body>
</html>