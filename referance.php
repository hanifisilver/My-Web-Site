<div class="container text-center">
    <h6 class="subtitle">Referans</h6>
    <h6 class="section-title mb-4">İnsanlar Benim Hakkımda Ne Düşünüyor</h6>
    <!-- <p class="mb-5 pb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. In alias dignissimos. <br> rerum commodi corrupti, temporibus non quam.</p> -->

    <!-- <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators mb-4">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="card testmonial-card border">
                    <div class="card-body">
                        <img src="assets/imgs/avatar-1.jpg" alt="">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam nostrum voluptates in enim vel amet?</p>
                        <h1 class="title">Emma Re</h1>
                        <h1 class="subtitle">Graphic Designer</h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="card testmonial-card border">
                    <div class="card-body">
                        <img src="assets/imgs/avatar-2.jpg" alt="">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam nostrum voluptates in enim vel amet?</p>
                        <h1 class="title">James Bert</h1>
                        <h1 class="subtitle">Web Designer</h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="card testmonial-card border">
                    <div class="card-body">
                        <img src="assets/imgs/avatar-3.jpg" alt="">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam nostrum voluptates in enim vel amet?</p>
                        <h1 class="title">Michael Abra</h1>
                        <h1 class="subtitle">Web Developer</h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="card testmonial-card border">
                    <div class="card-body">
                        <img src="assets/imgs/MehmetHanifiGumusProfil.jpg" alt="">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam nostrum voluptates in enim vel amet?</p>
                        <h1 class="title">Mehmet Hanifi Gümüş</h1>
                        <h1 class="subtitle">Full Stack Web Developer</h1>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


    <?php
        include "connection.php"; // Veritabanı bağlantısı

        // Onaylanmış yorumları çek
        // $stmt = $con->query("SELECT * FROM comment WHERE CommentStatus = 0 ORDER BY CreateDate DESC");
        // $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $sql = "SELECT * FROM comment WHERE CommentStatus = 1";
        $result = mysqli_query($con, $sql); // mysqli_query ile sorgu çalıştırılıyor
    ?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <!-- Slider Göstergeleri -->
    <ol class="carousel-indicators mb-4">
        <?php 
        $maxIndicators = 10; // Gösterge sayısını sınırlıyoruz (örneğin 5)
        foreach ($result as $index => $comment): 
            if ($index >= $maxIndicators) break; // 5'ten fazla göstergeler gösterilmez
        ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>"></li>
        <?php endforeach; ?>
    </ol>

    <!-- Slider İçeriği -->
    <div class="carousel-inner">
        <?php foreach ($result as $index => $comment): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>" >
                <div class="card testmonial-card border" style="height: 350px;">
                    <div class="card-body">
                        <img src="<?= htmlspecialchars($comment['ProfilPhoto']) ?>" alt="<?= htmlspecialchars($comment['NameSurname']) ?>">
                        <p><?= htmlspecialchars($comment['Comment']) ?></p>
                        <h1 class="title"><?= htmlspecialchars($comment['NameSurname']) ?></h1>
                        <h1 class="subtitle mb-2"><?= htmlspecialchars($comment['JobTitle']) ?></h1>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Slider Kontrolleri -->
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Önceki</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Sonraki</span>
    </a>
</div>
    <button type="button" class="btn btn-primary rounded mt-5" data-toggle="modal" data-target="#exampleModalCenter">
        Yorum Yap
    </button>
            <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">YORUM YAP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-2">
                    <form id="contact" action="uploadComment.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group p-2">
                            <input type="file" name="profile_image" class="form-control">
                        </div>
                        <div class="form-group p-2">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Adınız Soyadınız" required>
                        </div>
                        <div class="form-group p-2">
                            <input type="text" class="form-control rounded" name="job" placeholder="Mesleğinizi girin">
                        </div>
                        <div class="form-group p-2">
                            <textarea class="form-control border border-gray-300" minlength="50" maxlength="200" name="comment" rows="5" placeholder="Yorumunuzu yazın"></textarea>
                        </div>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                        <button type="submit" class="btn btn-primary">Gönder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


        


