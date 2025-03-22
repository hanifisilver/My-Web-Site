

<div class="container text-center">
            <h6 class="subtitle">İletişim</h6>
            <h6 class="section-title mb-4">Benimle İletişime Geç</h6>
            <!-- <p class="mb-5 pb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. In alias dignissimos. <br> rerum commodi corrupti, temporibus non quam.</p> -->

            <div class="contact text-left">
                <div class="form">
                    <h6 class="subtitle">24/7 iletişim</h6>
                    <h6 class="section-title mb-4">İletişme Geçin</h6>
                    <form id="contact" action="mailsend.php" method="POST">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Adınız" required>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Konu" required>
                        </div>
                        <div class="form-group">
                            <textarea name="message" id="message" cols="30" rows="5" class="form-control" placeholder="Mesajınız"></textarea>
                        </div>
                        <button type="submit" id="form-submit" class="btn btn-primary btn-block rounded w-lg">Gönder</button>
                    </form>
                </div>
                <div class="contact-infos">
                    <div class="item">
                        <i class="ti-location-pin"></i>
                        <div class="">
                            <h5>Lokasyon</h5>
                            <p> İstanbul / Türkiye</p>
                        </div>                          
                    </div>
                    <div class="item">
                        <i class="ti-mobile"></i>
                        <div>
                            <h5>Telefon Numarası</h5>
                            <p>(534) 511-1341</p>
                        </div>                          
                    </div>
                    <div class="item">
                        <i class="ti-email"></i>
                        <div class="mb-0">
                            <h5>E-mail</h5>
                            <p>mehmethanifigm@gmail.com</p>
                        </div>
                    </div>
                </div>                  
            </div>
        </div>

        
         
        <div id="map">
            <iframe src="https://snazzymaps.com/embed/61257"></iframe>
        </div> 