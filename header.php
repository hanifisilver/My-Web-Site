<div class="container">
            <div class="infos">
                <h6 class="subtitle">Merhaba, Ben</h6>
                <h6 class="title">Mehmet Hanifi Gümü<a href="" style="color:#495057; hover:text-decoration-none">ş</a></h6>
                <p>Full Stack Web Developer</p>

                <div class="buttons pt-3">
                    <!-- <button class="btn btn-primary rounded">HIRE ME</button> -->
                    <a href="mehmet_hanifi_gumus.pdf" target="_blank" download="mehmet_hanifi_gumus.pdf">
                        <button class="btn btn-dark rounded">CV İNDİR</button>
                    </a>                    
                </div>      

                <div class="socials mt-4">
                    <a href="https://www.linkedin.com/in/profilin" target="_blank" class="social-item">
                        <i class="fa-brands fa-linkedin fa text-blue-400"></i>
                    </a>
                    <a href="https://www.kariyer.net/profilin" target="_blank" class="social-item">
                        <i class="fa-solid fa-briefcase  text-gray-600"></i>
                    </a>
                    <!-- <a class="social-item" href="javascript:void(0)"><i class="ti-">linkedin</i></a>
                    <a class="social-item" href="javascript:void(0)"><i class="ti-">kariyernet</i></a> -->
                    <a class="social-item" href="javascript:void(0)"><i class="ti-github"></i></a>
                    <!-- <a href="https://www.kariyer.net/profilin" target="_blank" class="social-item">
                        <i class="fa-brands fa-youtube"></i>
                    </a> -->
                </div>
            </div>              
            <div class="img-holder">
                <!-- <img src="assets/imgs/man.svg" alt=""> -->
            </div>      
        </div>  

        <?php
            // connection.php dosyasını dahil et
            include('connection.php');

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

        <!-- Header-widget -->
        <div class="widget">
            <div class="widget-item">
                <h2>2+</h2>
                <p>Tecrübe</p>
            </div>
            <div class="widget-item">
                <h2><?php echo $commentCount; ?></h2>
                <p>Referans & Yorumlar</p>
            </div>
            <div class="widget-item">
                <h2>20</h2>
                <p>Sertifika</p>
            </div>
        </div>