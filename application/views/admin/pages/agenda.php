<!-- ########## START: MAIN PANEL ########## -->
<div class="br-mainpanel">
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="<?= base_url("admin/profile") ?>">Slider</a>
            <span class="breadcrumb-item active">Admin</span>
        </nav>
    </div><!-- br-pageheader -->
    <div class="br-pagetitle">
        <i class="icon icon ion-ios-photos-outline"></i>
        <div>
            <h4>Informasi Data Agenda Museum</h4>
            <p class="mg-b-0">
                Informasi Data Agenda Museum.
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
                                    <button class="btn btn-md btn-primary" onclick="add_agenda()">
                                        <i class="fa fa-plus"></i>
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-5">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tbl_survei" class="table display table-hover nowrap" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>File Images</th>
                                                <th>Penulis</th>
                                                <th>Judul</th>
                                                <th>Deskrispi</th>
                                                <th>#action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($agendadata) > 0) { ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($agendadata as $row) { ?>
                                                    <tr>
                                                        <td><span><?= $no++; ?></span></td>
                                                        <td>
                                                            <div class="media mg-t-20 mg-b-0">
                                                                <img src="<?= base_url() ?>public/upload/kegiatan/agenda/<?= $row->file_img; ?>" class="d-flex wd-100 rounded-circle mg-r-8" alt="Image">
                                                                <div class="media-body">
                                                                </div><!-- media-body -->
                                                            </div><!-- media -->
                                                        </td>
                                                        <td>
                                                            <p><?= $row->penulis; ?></p>
                                                        </td>
                                                        <td>
                                                            <p><?= $row->judul; ?></p>
                                                        </td>
                                                        <td>
                                                            <p><?= substr($row->deskripsi, 168, 300) . "..." ?></p>
                                                        </td>
                                                        <td>
                                                            <div class="input-group">
                                                                <button class="btn btn-md btn-warning">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <button class="btn btn-md btn-danger">
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
                <h5 class="modal-title text-white" id="my-modal-title">Tambah Data Agenda</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="form_agenda" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">File Upload</label>
                                <input type="file" name="file_image" id="file_image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Upload</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Judul Besar</label>
                                <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan Judul">
                            </div>
                            <label for="">Deskripsi</label>
                            <div style="max-height: 500px" id="summernote"></div>
                            <div class="form-group">
                                <label for="">Penulis</label>
                                <input type="text" name="penulis" id="penulis" class="form-control" placeholder="Masukkan Penulis">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-md btn-primary button-prevent" onclick="simpan_data_agenda()">
                            <i class="fa fa-save hide-text"></i>
                            <span class="hide-text">Simpan</span>
                            <div class="spinner" style="display: none;">
                                <img src="<?= base_url() ?>public/admin/img/loading_2.gif" alt="" style="width: 15%;height: 15%;">
                                Loading..
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>