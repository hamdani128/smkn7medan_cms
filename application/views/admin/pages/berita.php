<!-- ########## START: MAIN PANEL ########## -->
<div class="br-mainpanel">
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="<?= base_url("admin/orgranisasi") ?>">Slider</a>
            <span class="breadcrumb-item active">Admin</span>
        </nav>
    </div><!-- br-pageheader -->
    <div class="br-pagetitle">
        <i class="icon icon ion-ios-photos-outline"></i>
        <div>
            <h4>Informasi Data Berita</h4>
            <p class="mg-b-0">
                Informasi Data Berita Seluruh Kegiatan Museum.
            </p>
        </div>
    </div><!-- d-flex -->

    <div class="br-pagebody">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="button-group">
                                    <button class="btn btn-md btn-primary" onclick="add_berita()">
                                        <i class="fa fa-plus"></i>
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-5">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tbl_berita" class="table display table-hover nowrap"
                                        style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori</th>
                                                <th>File Image</th>
                                                <th>Judul Berita</th>
                                                <th>Tanggal Berita</th>
                                                <th>Content</th>
                                                <th>Penulis</th>
                                                <th>#action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($berita) > 0) { ?>
                                            <?php $no = 1; ?>
                                            <?php foreach ($berita as $row) { ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $row->kategori; ?></td>
                                                <td>
                                                    <div class="media mg-t-20 mg-b-0">
                                                        <img src="<?= base_url() ?>public/upload/berita/<?= $row->file_img; ?>"
                                                            class="d-flex wd-100 rounded-circle mg-r-8" alt="Image">
                                                        <div class="media-body">
                                                        </div><!-- media-body -->
                                                    </div><!-- media -->
                                                </td>
                                                <td><?= substr($row->judul, 0, 50) . "..."; ?></td>
                                                <td><?= $row->tanggal; ?></td>
                                                <td>
                                                    <p style="text-align: justify;">
                                                        <?= substr($row->detail_1, 400, 50) . "..." ?></p>
                                                </td>
                                                <td><?= $row->penulis; ?></td>
                                                <td>
                                                    <div class="input-group">
                                                        <button class="btn btn-danger btn-md"
                                                            onclick="delete_berita_admin('<?= $row->judul; ?>', '<?= $row->id; ?>')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div><!-- br-pagebody -->

</div><!-- br-mainpanel -->
<!-- ########## END: MAIN PANEL ########## -->


<!-- Modal Tambah -->
<div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="my-modal-title">Tambah Data Berita</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="form_berita" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">File Upload</label>
                                <input type="file" name="file_image" id="file_image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="cmb_kategori" id="cmb_kategori" class="form-control">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Event">Event</option>
                                    <option value="Sosialisasi">Sosialisasi</option>
                                    <option value="Komunitas">Komunitas</option>
                                    <option value="Pendidikan">Pendidikan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Judul Berita</label>
                                <textarea name="judul" id="judul" rows="5" cols="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Berita</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Detail Berita 1</label>
                                <textarea rows="20" cols="20" class="form-control" name="detail_1"
                                    id="summernote"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-md btn-dark" type="button" onclick="tambah_baris_gambar()">
                                    <i class="fa fa-plus"></i>
                                    Tambah Image Body
                                </button>
                                <div id="container"></div>
                            </div>
                            <div class="form-group">
                                <label for="">Detail Berita 2</label>
                                <textarea rows="20" cols="20" class="form-control" name="detail_2"
                                    id="summernote2"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Penulis</label>
                                <input type="text" name="penulis" id="penulis" class="form-control"
                                    placeholder="Masukkan Penulis">
                            </div>
                            <div class="form-group">
                                <label for="">Sumber</label>
                                <input type="text" name="sumber" id="sumber" class="form-control"
                                    placeholder="Masukkan Penulis">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-md btn-primary button-prevent" onclick="simpan_data_berita()">
                            <i class="fa fa-save hide-text"></i>
                            <span class="hide-text">Simpan</span>
                            <div class="spinner" style="display: none;">
                                <img src="<?= base_url() ?>public/admin/img/loading_2.gif" alt=""
                                    style="width: 15%;height: 15%;">
                                Loading..
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>