<!-- Start latest course section -->
<section id="mu-latest-courses">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="mu-latest-courses-area">
                    <!-- Start Title -->
                    <div class="mu-title">
                        <h2>Daftar Jurusan </h2>
                        <p>Berikut ini adalah daftar jurusan di SMKN 7 Medan paling terbaru:</p>
                    </div>
                    <!-- End Title -->
                    <!-- Start latest course content -->
                    <div id="mu-latest-course-slide" class="mu-latest-courses-content">
                        <?php if (count($jurusan) > 0) { ?>
                            <?php foreach ($jurusan as $row) { ?>
                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="mu-latest-course-single">
                                        <figure class="mu-latest-course-img">
                                            <a href="#"><img src="<?= base_url() ?>public/upload/jurusan/<?= $row->file_img; ?>" alt="img"></a>
                                            <figcaption class="mu-latest-course-imgcaption">
                                                <a href="#">Detail Info :</a>
                                            </figcaption>
                                        </figure>
                                        <div class="mu-latest-course-single-content">
                                            <h4 style="font-weight: 800;"><a href="#">Jurusan <?= $row->nama_jurusan; ?>.</a>
                                            </h4>
                                            <p>
                                                <?= $row->deskripsi; ?>
                                            </p>
                                            <!-- <div class="mu-latest-course-single-contbottom">
                                        <a class="mu-course-details" href="#">Details</a>
                                        <span class="mu-course-price" href="#">$165.00</span>
                                    </div> -->
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="col-lg-12 col-md-12 col-xs-12 text-center">
                                <h5>Data Empty</h5>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- End latest course content -->
                </div>
            </div>
        </div>
    </div>
</section>