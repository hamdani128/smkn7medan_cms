<section id="mu-course-content" ng-app="HomeAppProfile" ng-controller="HomeAppProfileController">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-course-content-area">
                    <div class="row">
                        <div class="mu-title">
                            <h2>Berita dan Profile Terkini</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <!-- start course content container -->
                            <div class="mu-course-container mu-blog-archive">
                                <div class="row">
                                    <div>
                                        <div class="col-md-6 col-sm-12"
                                            ng-repeat="dt in LoadData | startFrom:(currentPage - 1) * itemsPerPage | limitTo: itemsPerPage"
                                            ng-animate="'animate'">
                                            <div class="card">
                                                <div class="card-body">
                                                    <article class="mu-blog-single-item">
                                                        <figure class="mu-blog-single-img">
                                                            <a href="#">
                                                                <img ng-src="{{ '<?= base_url() ?>public/upload/berita/' + dt.file_img }}"
                                                                    alt="img">
                                                            </a>
                                                            <figcaption class="mu-blog-caption">
                                                                <h3><a href="#">{{dt.judul}}</a></h3>
                                                            </figcaption>
                                                        </figure>
                                                        <div class="mu-blog-meta">
                                                            <a href="#">By {{dt.penulis}}</a>
                                                            <a href="#">{{dt.tanggal}}</a>
                                                            <!-- <span><i class="fa fa-comments-o"></i>87</span> -->
                                                        </div>
                                                        <div class="mu-blog-description">
                                                            <!-- {{dt.detail_1}} -->
                                                            <a class="mu-read-more-btn" href="#">Read More</a>
                                                        </div>
                                                    </article>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-12 col-md-12" ng-if="LoadData.length === 0">
                                        <h5>Data Kegiatan Kosong</h5>
                                    </div> -->
                                </div>
                            </div>
                            <!-- end course content container -->
                            <!-- start course pagination -->
                            <div class="mu-pagination">
                                <nav>
                                    <ul class="pagination">
                                        <li>
                                            <a href="javascript:void(0);" aria-label="Previous" ng-click="prevPage()">
                                                <span class="fa fa-angle-left"></span> Prev
                                            </a>
                                        </li>
                                        <li ng-repeat="page in pages" ng-class="{active: currentPage === page}">
                                            <a href="javascript:void(0);" ng-click="setPage(page)">{{ page }}</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" aria-label="Next" ng-click="nextPage()">
                                                Next <span class="fa fa-angle-right"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <!-- end course pagination -->
                        </div>
                        <div class="col-md-4">
                            <!-- start sidebar -->
                            <aside class="mu-sidebar">
                                <!-- start single sidebar -->
                                <div class="mu-single-sidebar">
                                    <h3></h3>
                                    <figure class="mu-latest-course-img text-center">
                                        <a href="#">
                                            <img src="<?= base_url() ?>public/upload/pimpinan/<?= $pimpinan->file_img; ?>"
                                                alt="img" style="width: 70%;height: 70%;">
                                        </a>
                                    </figure>
                                    <div class="mu-latest-course-single-content text-center">
                                        <h4 style="font-weight: bold;"><a href="#"><?= $pimpinan->nama; ?></a></h4>
                                        <h4 style="font-weight: bold;"><?= $pimpinan->jabatan; ?></h4>

                                    </div>
                                </div>

                                <!-- end single sidebar -->
                            </aside>
                            <!-- / end sidebar -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<style>
.animate-enter,
.animate-leave {
    -webkit-transition: 0.5s ease-in-out opacity;
    transition: 0.5s ease-in-out opacity;
}

.animate-enter.animate-enter-active,
.animate-leave {
    opacity: 1;
}

.animate-leave.animate-leave-active,
.animate-enter {
    opacity: 0;
}
</style>