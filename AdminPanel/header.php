
<!-- Sidebar -->
<aside class="w-64 bg-gray-800 p-5 space-y-6 hidden md:block">
    <h2 class="text-2xl font-semibold">Admin Paneli</h2>
    <nav>
        <a href="index.php" class="block py-2 px-4 rounded bg-gray-700">Ana Sayfa</a>
        <a href="approval.php" class="block py-2 px-4 rounded hover:bg-gray-700">Onayda Bekleyen Yorumlar</a>
        <a href="allcomment.php" class="block py-2 px-4 rounded hover:bg-gray-700">Tüm Yorumlar</a>
        <a href="setting.php" class="block py-2 px-4 rounded hover:bg-gray-700">Ayarlar</a>
        <a href="locationsite.php" class="block py-2 px-4 rounded hover:bg-gray-700">Siteye Dön</a>
        <a href="logout.php" class="block py-2 px-4 rounded bg-red-600 hover:bg-red-700">Çıkış Yap</a>
    </nav>
</aside>
<?php include('SQLQuery.php'); ?>
<!-- Mobile Sidebar Toggle Button -->
<button id="menu-toggle" class="md:hidden fixed top-4 left-4 bg-gray-800 p-2 rounded text-white">☰</button>


<script>
    document.getElementById("menu-toggle").addEventListener("click", function() {
        document.querySelector("aside").classList.toggle("hidden");
    });
</script>
