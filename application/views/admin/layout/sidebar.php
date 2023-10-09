<!-- ########## START: LEFT PANEL ########## -->
<div class="br-logo"><a href=""><span>[</span> CMS APP - <i> SMK NEGERI 7 MEDAN</i><span>]</span></a></div>
<div class="br-sideleft sideleft-scrollbar">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigation</label>
    <ul class="br-sideleft-menu">
        <li class="br-menu-item">
            <a href="<?= base_url('usr/dashboard') ?>"
                class="br-menu-link <?= uri_string() == 'usr/dashboard' ? 'active' : '' ?>">
                <i class="menu-item-icon icon ion-ios-home-outline tx-20"></i>
                <span class="menu-item-label">Dashboard</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="<?= base_url("usr/slider") ?>"
                class="br-menu-link <?= uri_string() == 'usr/slider' ? 'active' : '' ?>">
                <i class="menu-item-icon icon ion-ios-email-outline tx-24"></i>
                <span class="menu-item-label">Slider</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="#"
                class="br-menu-link with-sub  <?= uri_string() == 'usr/profile' || uri_string() == 'usr/visimisi' ||  uri_string() == 'usr/pimpinan' ||  uri_string() == 'usr/organisasi' ? 'active' : '' ?>">
                <i class="menu-item-icon icon ion-ios-folder-outline tx-20"></i>
                <span class="menu-item-label">Profile</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item">
                    <a href="<?= base_url("usr/profile") ?>"
                        class="sub-link <?= uri_string() == 'usr/profile' ? 'active' : '' ?>">
                        Profile
                    </a>
                </li>
                <li class="sub-item">
                    <a href="<?= base_url("usr/visimisi") ?>"
                        class="sub-link <?= uri_string() == 'usr/visimisi' ? 'active' : '' ?>">
                        Visi Misi
                    </a>
                </li>
                <li class="sub-item">
                    <a href="<?= base_url("usr/pimpinan") ?>"
                        class="sub-link <?= uri_string() == 'usr/pimpinan' ? 'active' : '' ?>">
                        Profile Pimpinan
                    </a>
                </li>
                <li class="sub-item">
                    <a href="<?= base_url("usr/organisasi") ?>"
                        class="sub-link <?= uri_string() == 'usr/organisasi' ? 'active' : '' ?>">
                        Struktur Organisasi
                    </a>
                </li>
            </ul>
        </li>
        <li class="br-menu-item">
            <a href="<?= base_url("usr/berita") ?>"
                class="br-menu-link <?= uri_string() == 'usr/berita' ? 'active' : '' ?>">
                <i class="menu-item-icon icon ion-ios-folder-outline tx-20"></i>
                <span class="menu-item-label">Berita</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="<?= base_url("usr/pengumuman") ?>"
                class="br-menu-link <?= uri_string() == 'usr/pengumuman' ? 'active' : '' ?>">
                <i class="menu-item-icon icon ion-ios-folder-outline tx-20"></i>
                <span class="menu-item-label">Pengumuman</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->

        <li class="br-menu-item">
            <a href="<?= base_url("usr/galeri") ?>"
                class="br-menu-link <?= uri_string() == 'usr/galeri' ? 'active' : '' ?>">
                <i class="menu-item-icon icon ion-ios-folder-outline tx-20"></i>
                <span class="menu-item-label">Galeri Photo Kegiatan</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="<?= base_url("usr/galeri/video") ?>"
                class="br-menu-link <?= uri_string() == 'usr/galeri/video' ? 'active' : '' ?>">
                <i class="menu-item-icon icon ion-ios-folder-outline tx-20"></i>
                <span class="menu-item-label">Galeri Video</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->

        <?php if ($this->session->userdata('level') == "Super Admin") { ?>
        <li class="br-menu-item">
            <a href="<?= base_url("usr/person") ?>"
                class="br-menu-link <?= uri_string() == 'usr/person' ? 'active' : '' ?>">
                <i class="menu-item-icon icon ion-ios-bookmarks tx-20"></i>
                <span class="menu-item-label">Account</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        <?php } ?>
    </ul><!-- br-sideleft-menu -->
</div>
<!-- br-sideleft -->
<!-- ########## END: LEFT PANEL ########## -->