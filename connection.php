<?php
$host = 'localhost'; // Veritabanı sunucusunun adresi
$db   = 'hanifigumusDB'; // Veritabanının adı
$user = 'root'; // Veritabanı kullanıcı adı
$pass = ''; // Veritabanı şifresi
$con = mysqli_connect($host,$user,$pass);

if($con){
    echo "";
}else{
    echo "Bağlantı Başarısız Oldu";
}

@mysqli_select_db($con,$db) or die ("Veritabanı Bağlantısı Başarısız");


?>