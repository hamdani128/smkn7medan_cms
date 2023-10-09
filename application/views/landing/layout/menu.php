<!-- Start menu -->
<section id="mu-menu">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- LOGO -->
                <!-- TEXT BASED LOGO -->
                <a class="navbar-brand" href="index.html" style="display: flex; align-items: center;margin-top: 10px;">
                    <img src="<?= base_url() ?>public/landing/img/logo.png" alt="Logo" style="width: 50px; height: auto;margin-right: 5px;">
                    <span style="font-size: 12pt;">SMK Negeri 7 Medan</span>
                </a>
                <!-- IMG BASED LOGO  -->
                <!-- <a class="navbar-brand" href="index.html"><img src="<?= base_url() ?>public/landing/img/logo.png"
                            alt="logo" style="height: 300%;"> dsad</a> -->
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
                    <li class="active"><a href="index.html">Profile</a></li>
                    <li><a href="#">Visi Misi</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            PPDB
                            <span class="fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Formulir PPDB</a></li>
                            <li><a href="#">Hasil Seleksi</a></li>
                            <li><a href="#">Cetak Formulir</a></li>
                            <li><a href="#">Download Formulir</a></li>
                        </ul>
                    </li>
                    <li><a href="404.html">Berita</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Lainnya<span class="fa fa-angle-down"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="blog-archive.html">Pengumuman</a></li>
                            <li><a href="blog-single.html">Galery</a></li>
                            <li><a href="blog-single.html">Kategori</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.html">Contact</a></li>

                    <li><a href="#" id="mu-search-icon"><i class="fa fa-search"></i></a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>
</section>
<!-- End menu -->