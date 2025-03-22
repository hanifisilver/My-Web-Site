<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'sitemaster.php';?>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">
<style>
        .alert {
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
<!-- Alert Mesajı Burada Gösterilecek -->
<div id="alert-box"></div>

<script>
    // Sayfa yüklendiğinde, URL'den gelen "status" parametresini kontrol et
    console.log(status);
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        const status = urlParams.get('status');

        if (status === 'success') {
            // Başarılı Mail Gönderimi
            // console.log("Merhaba JavaScript 4");
            // console.log(status);
            // document.getElementById("alert-box").innerHTML = `
            //     <div class="alert alert-success">
            //         Mailiniz başarıyla gönderildi!
            //     </div>
            // `;
            alert("✅ Mailiniz başarıyla gönderildi!");
        } else if (status === 'error') {
            // Hatalı Mail Gönderimi
            console.log("Merhaba JavaScript 3");
            console.log(status);
            document.getElementById("alert-box").innerHTML = `
                <div class="alert alert-error">
                ❌ Mail gönderimi başarısız oldu. Lütfen tekrar deneyin.
                </div>
            `;
        }

        // 3 saniye sonra alerti gizleyelim
        setTimeout(function() {
            document.getElementById("alert-box").innerHTML = ''; // Alerti temizle
        }, 3000); // 3 saniye (3000 ms) sonra

        // URL'den status parametresini temizle
        if (urlParams.has('status')) {
            urlParams.delete('status');
            window.history.replaceState({}, '', window.location.pathname); // URL parametrelerini temizle
        }
    }
</script>
    <!-- Page Navigation & Header -->
    <header class="header" id="home">
        <?php include 'navbar.php';?> 
        <?php include 'header.php';?> 
    </header>
    <!-- End of page navibation -->
    
    <!-- About section -->
    <section id="about" class="section mt-3">
        <?php include 'about.php';?>
    </section>      

    <!-- Service section -->
    <section id="service" class="section" style="">
        <?php include 'services.php';?>
    </section>
    <!-- End of Sectoin -->

    <!-- Skills section -->
    <section class="section" id="skils">
        <?php include 'skils.php';?> 
    </section>
    <!-- End of Skills sections -->

    <!-- Portfolio section -->
    <!-- <section id="portfolio" class="section">
        <div class="container text-center">
            <h6 class="subtitle">Portfolio</h6>
            <h6 class="section-title mb-4">Check My Wonderful Works</h6>
            <p class="mb-5 pb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. In alias dignissimos. <br> rerum commodi corrupti, temporibus non quam.</p>

            <div class="row">
                <div class="col-sm-4">
                    <div class="img-wrapper">
                        <img src="assets/imgs/folio-1.jpg" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Project Title</h5>
                                <a href="javascript:void(0)"><i class="ti-zoom-in"></i></a>
                                <a href="javascript:void(0)"><i class="ti-link"></i></a>
                            </div>  
                        </div>
                    </div>
                    <div class="img-wrapper">
                        <img src="assets/imgs/folio-2.jpg" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Project Title</h5>
                                <a href="javascript:void(0)"><i class="ti-zoom-in"></i></a>
                                <a href="javascript:void(0)"><i class="ti-link"></i></a>
                            </div>                              
                        </div>
                    </div>                  
                </div>
                <div class="col-sm-4">
                    <div class="img-wrapper">
                        <img src="assets/imgs/folio-3.jpg" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Project Title</h5>
                                <a href="javascript:void(0)"><i class="ti-zoom-in"></i></a>
                                <a href="javascript:void(0)"><i class="ti-link"></i></a>
                            </div>  
                        </div>
                    </div>
                    <div class="img-wrapper">
                        <img src="assets/imgs/folio-4.jpg" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Project Title</h5>
                                <a href="javascript:void(0)"><i class="ti-zoom-in"></i></a>
                                <a href="javascript:void(0)"><i class="ti-link"></i></a>
                            </div>                              
                        </div>
                    </div>                  
                </div>
                <div class="col-sm-4">
                    <div class="img-wrapper">
                        <img src="assets/imgs/folio-5.jpg" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Project Title</h5>
                                <a href="javascript:void(0)"><i class="ti-zoom-in"></i></a>
                                <a href="javascript:void(0)"><i class="ti-link"></i></a>
                            </div>  
                        </div>
                    </div>
                    <div class="img-wrapper">
                        <img src="assets/imgs/folio-6.jpg" alt="">
                        <div class="overlay">
                            <div class="overlay-infos">
                                <h5>Project Title</h5>
                                <a href="javascript:void(0)"><i class="ti-zoom-in"></i></a>
                                <a href="javascript:void(0)"><i class="ti-link"></i></a>
                            </div>                              
                        </div>
                    </div>                  
                </div>
            </div>

        </div>
    </section>-->
    <!-- End of portfolio section -->

    <!-- Testmonial Section -->
    <section id="referance" class="section">
        <?php include 'referance.php';?> 
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            
            if (urlParams.has("comment_success")) {
                alert("✅ Yorumunuz başarıyla eklendi!");
                window.history.replaceState({}, document.title, window.location.pathname);
            } else if (urlParams.has("comment_error")) {
                alert("❌ Yorum eklenirken hata oluştu!");
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        });
    </script>
    <!-- End of testmonial section -->

    <!-- Blog Section -->
    <!-- <section id="blog" class="section"> 
        <div class="container text-center">
            <h6 class="subtitle">My Blogs</h6>
            <h6 class="section-title mb-4">Latest News</h6>
            <p class="mb-5 pb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. In alias dignissimos. <br> rerum commodi corrupti, temporibus non quam.</p>

            <div class="row text-left">
                <div class="col-md-4">
                    <div class="card border mb-4">
                        <img src="assets/imgs/blog-1.jpg" alt="" class="card-img-top w-100">
                        <div class="card-body">
                            <h5 class="card-title">Designe for Everyone</h5>
                            <div class="post-details">
                                <a href="javascript:void(0)">Posted By: Admin</a>
                                <a href="javascript:void(0)"><i class="ti-thumb-up"></i> 456</a>
                                <a href="javascript:void(0)"><i class="ti-comment"></i> 123</a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut ad vel dolorum, iusto velit, minima? Voluptas nemo harum impedit nisi.</p>
                            <a href="javascript:void(0)">Read More..</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border mb-4">
                        <img src="assets/imgs/blog-2.jpg" alt="" class="card-img-top w-100">
                        <div class="card-body">
                            <h5 class="card-title">Web Layouts</h5>
                            <div class="post-details">
                                <a href="javascript:void(0)">Posted By: Admin</a>
                                <a href="javascript:void(0)"><i class="ti-thumb-up"></i> 456</a>
                                <a href="javascript:void(0)"><i class="ti-comment"></i> 123</a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut ad vel dolorum, iusto velit, minima? Voluptas nemo harum impedit nisi.</p>
                            <a href="javascript:void(0)">Read More..</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border mb-4">
                        <img src="assets/imgs/blog-3.jpg" alt="" class="card-img-top w-100">
                        <div class="card-body">
                            <h5 class="card-title">Bootstrap Framework</h5>
                            <div class="post-details">
                                <a href="javascript:void(0)">Posted By: Admin</a>
                                <a href="javascript:void(0)"><i class="ti-thumb-up"></i> 456</a>
                                <a href="javascript:void(0)"><i class="ti-comment"></i> 123</a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ut ad vel dolorum, iusto velit, minima? Voluptas nemo harum impedit nisi.</p>
                            <a href="javascript:void(0)">Read More..</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->

    <!-- Hire me section -->
    <!-- <section class="bg-gray p-0 section"> 
        <div class="container">
            <div class="card bg-primary">
                <div class="card-body text-light">
                    <div class="row align-items-center">
                        <div class="col-sm-9 text-center text-sm-left">
                            <h5 class="mt-3">Hire Me For Your Project</h5>
                            <p class="mb-3">Accusantium labore nostrum similique quisquam.</p>
                        </div>
                        <div class="col-sm-3 text-center text-sm-right">
                            <button class="btn btn-light rounded">Hire Me!</button>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>  -->    
    <!-- End od Hire me section. -->

    <!-- Contact Section -->
    <section id="contact" class="position-relative section">
        <?php include 'contact.php';?>     
    </section>
    <!-- End of Contact Section -->

    <!-- Page Footer -->
    <footer class="page-footer">
        <?php include 'footer.php';?> 
    </footer> 
    <!-- End of page footer -->
</body>
</html>
