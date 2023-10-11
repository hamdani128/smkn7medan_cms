<!-- Start about us -->
<section id="mu-about-us">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-about-us-area">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="mu-about-us-left">
                                <!-- Start Title -->
                                <div class="mu-title">
                                    <h2>Informasi Tentang Sekolah</h2>
                                </div>
                                <!-- End Title -->
                                <?= $profile->deskripsi; ?>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="mu-about-us-right">
                                <a id="mu-abtus-video" href="https://www.youtube.com/embed/FE5ogSYvfZ8" target="mutube-video">
                                    <img src="<?= base_url() ?>public/upload/profile/<?= $profile->file_img; ?>" alt="img">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End about us -->