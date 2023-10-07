<!-- ########## START: MAIN PANEL ########## -->
<div class="br-mainpanel">
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="<?= base_url("admin/slider") ?>">Slider</a>
            <span class="breadcrumb-item active">Admin</span>
        </nav>
    </div><!-- br-pageheader -->
    <div class="br-pagetitle">
        <i class="icon icon ion-ios-photos-outline"></i>
        <div>
            <h4>Informasi Data Profile Pimpinan Museum</h4>
            <p class="mg-b-0">
                Informasi Data Profile Lengkap Pimpinan Museum.
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
                                    <button class="btn btn-md btn-primary" onclick="add_pimpinan()">
                                        <i class="fa fa-plus"></i>
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-5">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tbl_pimpinan" class="table display table-hover nowrap" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>File Image</th>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>#action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($pimpinan) > 0) { ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($pimpinan as $row) { ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td>
                                                            <div class="media mg-t-20 mg-b-0">
                                                                <img src="<?= base_url() ?>public/upload/pimpinan/<?= $row->file_img; ?>" class="d-flex wd-100 rounded-circle mg-r-8" alt="Image">
                                                                <div class="media-body">
                                                                </div><!-- media-body -->
                                                            </div><!-- media -->
                                                        </td>
                                                        <td><?= $row->nama; ?></td>
                                                        <td><?= $row->jabatan; ?></td>
                                                        <td>
                                                            <div class="input-group">
                                                                <button class="btn btn-md btn-warning" onclick="edit_pimpinan('<?= $row->id; ?>')">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                                <button class="btn btn-md btn-danger" onclick="delete_pimpinan('<?= $row->id; ?>', '<?= $row->nama; ?>')">
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
                <h5 class="modal-title text-white" id="my-modal-title">Tambah Data Profile Pimpinan</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="form_pimpinan" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">File Upload</label>
                                <input type="file" name="file_image" id="file_image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Pimpinan</label>
                                <input type="text" class="form-control" name="pimpinan" id="pimpinan" placeholder="Nama Pimpinan">
                            </div>
                            <div class="form-group">
                                <label for="">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan Pimpinan">
                            </div>
                        </div>
                    </div>
                </form>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-md btn-primary button-prevent" onclick="simpan_data_pimpinan()">
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


<!-- Update Modal -->
<div id="my-modal-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white" id="my-modal-title">Update Data Profile Pimpinan</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="form_pimpinan_update" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <img src="" alt="" id="img_display" style="width: 30%;height: 30%;">
                            </div>
                            <input type="hidden" name="id_update" id="id_update">
                            <div class="form-group">
                                <label for="">File Upload <span>(Jika Ingin Memperbaharui Image)</span></label>
                                <input type="file" name="file_image_update" id="file_image_update" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Pimpinan</label>
                                <input type="text" class="form-control" name="pimpinan_update" id="pimpinan_update" placeholder="Nama Pimpinan">
                            </div>
                            <div class="form-group">
                                <label for="">Jabatan</label>
                                <input type="text" class="form-control" name="jabatan_update" id="jabatan_update" placeholder="Jabatan Pimpinan">
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-md btn-warning button-prevent" onclick="update_data_pimpinan()">
                            <i class="fa fa-save hide-text"></i>
                            <span class="hide-text">Update</span>
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