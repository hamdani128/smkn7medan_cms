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
            <h4>Informasi Data Tentang Sekolah</h4>
            <p class="mg-b-0">
                Informasi Data Profile Lengkap Sekolah SMK NEGERI 7 MEDAN.
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
                                    <button class="btn btn-md btn-primary" id="btn-add-profile" onclick="add_profile()" style="display: block;">
                                        <i class="fa fa-plus"></i>
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-5">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tbl_profile" class="table display table-hover nowrap" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>File Image</th>
                                                <th>Deskripsi</th>
                                                <th>#action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php if (empty($profile)) { ?>
                                                <tr>
                                                    <td colspan="4" class="text-center">
                                                        <h5>No Data Record</h5>
                                                    </td>
                                                </tr>
                                            <?php } else { ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td>
                                                        <div class="media mg-t-20 mg-b-0">
                                                            <img src="<?= base_url() ?>public/upload/profile/<?= $profile->file_img; ?>" class="d-flex wd-100 rounded-circle mg-r-8" alt="Image">
                                                            <div class="media-body">
                                                            </div><!-- media-body -->
                                                        </div><!-- media -->
                                                    </td>
                                                    <td><?= $profile->deskripsi; ?></td>
                                                    <td>
                                                        <div class="input-group">
                                                            <button class="btn btn-md btn-warning" onclick="Edit_Profile('<?= $profile->id; ?>')">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                            <button class="btn btn-md btn-danger" onclick="Delete_Profile('<?= $profile->id; ?>')">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
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
                <h5 class="modal-title text-white" id="my-modal-title">Tambah Data Profile</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="form_profile" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">File Upload</label>
                                <input type="file" name="file_image" id="file_image" class="form-control">
                            </div>
                            <label for="">Deskripsi Tetang Museum Negeri</label>
                            <div id="summernote"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-md btn-primary button-prevent" onclick="simpan_data_profile_baru()">
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



<!-- Modal Update -->
<div id="my-modal-update" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title text-white" id="my-modal-title">Update Data Profile</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="form_profile_update" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" name="id_update" id="id_update" class="form-control">
                                <img src="" alt="" id="img_display" style="width: 100%;height: 50%;">
                            </div>
                            <div class="form-group">
                                <label for="">Jika Anda Menginginkan Perubahan Data Gambar Harap Upload Ulang Disini,
                                    Jika Tidak Dilanjutkan tanpa mengupload ulang data</label>
                                <input type="file" name="file_image_update" id="file_image_update" class="form-control">
                            </div>
                            <label for="">Deskripsi Tetang Museum Negeri</label>
                            <div id="summernote_update"></div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-md btn-warning button-prevent" onclick="update_data_profile()">
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