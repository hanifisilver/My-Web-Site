<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
require_once 'PHPMailer/src/Exception.php';

// $mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $k_adi = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mehmethanifigm@gmail.com'; // Kendi e-posta adresin
        $mail->Password = 'hqhwmnwcsdkwzafy';  // Gmail uygulama şifren
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8'; // Türkçe karakter desteği

        // Kimden ve kime gönderilecek
        $mail->setFrom($email, $k_adi); //GÖNDERİCİ
        $mail->addAddress('mehmethanifigm@gmail.com', 'Sen'); //ALICI

        // HTML Mail Şablonu
        $message = "
        <html>
        <head>
            <title>{$_POST['subject']}</title>
            <style>
                body { font-family: Arial, sans-serif; }
                .container { width: 100%; padding: 20px; background-color: #f4f4f4; }
                .mail-content { background: #fff; padding: 20px; border-radius: 8px; }
                .info { font-weight: bold; color: #333; }
                .message { margin-top: 10px; padding: 15px; background: #f9f9f9; border-left: 4px solid #007bff; }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='mail-content'>
                    <p class='info'>Gönderen: <b>{$_POST['name']}</b> ({$_POST['email']})</p>
                    <p class='info'>Konu: {$_POST['subject']}</p>
                    <div class='message'>" . nl2br($_POST['message']) . "</div>
                </div>
            </div>
        </body>
        </html>
        ";

        // Mail içeriğini HTML olarak gönder
        $mail->isHTML(true);
        $mail->Subject = $_POST['subject'];
        $mail->Body    = $message;
        $mail->AltBody = "Gönderen: {$_POST['name']} ({$_POST['email']})\n\nKonu: {$_POST['subject']}\n\n" . $_POST['message'];


        $mail->send();
        echo 'Mesaj başarıyla gönderildi.';
         // Mail gönderimi başarılı ise yönlendirme ve başarılı mesajı gönder
        header("Location: index.php?status=success");
        exit; // Yönlendirme sonrası kodun çalışmasını durdurur
    } catch (Exception $e) {
        // Mail gönderimi başarısız olduysa hata mesajını gönder
        header("Location: index.php?status=error");
        exit; // Yönlendirme sonrası kodun çalışmasını durdurur
    }
}else{
       echo "başarısız.";
     }



// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';



// if(isset($_POST['button']))
// {

//     $k_mail=$_POST['email'];
//     $k_adi=$_POST['name'];
//     $k_subject=$_POST['subject'];
//     $k_message=$_POST['message'];

//     $mail = new PHPMailer();
//     $mail->Host = "smtp.gmail.com";
//     $mail->Username = 'mehmethanifigm@gmail.com'; 
//     $mail->Password = 'h q h w m n w c s d k w z a f y';  //h q h w m n w c s d k w z a f y
//     $mail->Port = 587; 
//     $mail->SMTPSecure = 'tls'; 
//     $mail->isSMTP(); 
//     $mail->SMTPAuth = true;
//     $mail->isHTML(true);
//     $mail->CharSet = "UTF-8";
//     $mail->setLanguage('tr', 'PHPMailer/language/');
//     $mail->setFrom('otoparkweb@gmail.com', 'Parkweb');
//     $mail->addAddress('umutcanzdmrx@gmail.com', 'Parkweb');
//     $mail->Subject = 'Deneme mail gönderimi';
//     $mail->Body ="Deneme mail gönderimi";
//     $mail_gonder = $mail->send(); 
//     if($mail_gonder)
//     { 
//         echo 'Mail başarıyla gönderildi';
//     }
//     else
//     {
//         echo 'Mail gönderilemedi. Mail hata mesajı: '.
//         $mail->ErrorInfo; 
//     }
// }
// else{
//   echo "başarısız.";
// }



?> 