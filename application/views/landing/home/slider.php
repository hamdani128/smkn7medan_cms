<!-- Start Slider -->
<section id="mu-slider">

    <?php if (empty($slider)) { ?>
    <!-- Start single slider item -->
    <div class="mu-slider-single">
        <div class="mu-slider-img">
            <figure>
                <img src="<?= base_url() ?>public/landing/img/slider/1.jpg" alt="img">
            </figure>
        </div>
        <div class="mu-slider-content">
            <h4>Welcome To SMK Negeri 7 Medan</h4>
            <span></span>
        </div>
    </div>
    <!-- Start single slider item -->
    <?php } else { ?>
    <?php foreach ($slider as $row) { ?>
    <!-- Start single slider item -->
    <div class="mu-slider-single">
        <div class="mu-slider-img">
            <figure>
                <img src="<?= base_url() ?>public/upload/slider/<?= $row->file_img; ?>" alt="img">
            </figure>
        </div>
        <div class="mu-slider-content">
            <h3>SMK Negeri 7 Medan</h3>
            <span></span>
            <!-- <h2>Best Education Template Ever</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor amet error eius reiciendis eum sint
                        unde eveniet deserunt est debitis corporis temporibus recusandae accusamus.</p>
                    <a href="#" class="mu-read-more-btn">Read More</a> -->
        </div>
    </div>
    <!-- Start single slider item -->
    <?php } ?>
    <?php } ?>
</section>
<!-- End Slider -->