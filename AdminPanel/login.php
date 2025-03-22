<?php 
    session_start();
    include '../connection.php';
	include("..//ClassLibrary//function.php");
    
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$user_name = $_POST['username'];
		$password = $_POST['password'];
	
		if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {
			
			// Kullanıcıyı veritabanından çek
			$query = "SELECT * FROM adminuser WHERE UserName = ? LIMIT 1";
			$stmt = mysqli_prepare($con, $query);
			mysqli_stmt_bind_param($stmt, "s", $user_name);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
	
			if ($result && mysqli_num_rows($result) > 0) {
				$user_data = mysqli_fetch_assoc($result);
	
				// Şifreyi hash ile doğrula
				if (password_verify($password, $user_data['Password'])) {
					$_SESSION['AdminID'] = $user_data['AdminID'];
					header("Location: index.php");
					die;
				} else {
					echo "Hatalı kullanıcı adı ya da şifre!";
				}
			} else {
				echo "Hatalı kullanıcı adı ya da şifre!";
			}
	
			mysqli_stmt_close($stmt);
		} else {
			echo "Hatalı kullanıcı adı ya da şifre!";
		}
	}
?>
<!--  -->
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Giriş</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-r from-gray-800 to-gray-900">
    <div class="bg-gray-800 p-8 rounded-2xl shadow-lg max-w-sm w-full text-white">
        <h2 class="text-2xl font-semibold text-center mb-6">Admin Paneli</h2>
        <form action="login.php" method="POST">
            <div class="mb-4">
                <label class="block text-gray-400" for="username">Kullanıcı Adı</label>
                <input type="text" id="username" name="username" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-400" for="password">Şifre</label>
                <input type="password" id="password" name="password" class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg transition">Giriş Yap</button>
        </form>
    </div>
</body>
</html>
