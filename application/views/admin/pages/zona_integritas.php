<!-- ########## START: MAIN PANEL ########## -->
<div class="br-mainpanel">
    <div class="br-pageheader">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="<?= base_url("admin/profile") ?>">Zona Integritas</a>
            <span class="breadcrumb-item active">Admin</span>
        </nav>
    </div><!-- br-pageheader -->
    <div class="br-pagetitle">
        <i class="icon icon ion-ios-photos-outline"></i>
        <div>
            <h4>Informasi Data Zona Integritas Museum</h4>
            <p class="mg-b-0">
                Informasi Data yang menyampaikan informasi terkait support dan dukungan yang tertera.
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
                                    <button class="btn btn-md btn-primary" onclick="add_zona_integritas()">
                                        <i class="fa fa-plus"></i>
                                        Tambah Data
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-5">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="tbl_zona" class="table display table-hover nowrap" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>File Image</th>
                                                <th>URL</th>
                                                <th>Deskripsi</th>
                                                <th>#action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (count($zonadata) > 0) { ?>
                                            <?php $no = 1; ?>
                                            <?php foreach ($zonadata as $row) { ?>
                                            <tr>
                                                <td><span><?= $no++; ?></span></td>
                                                <td>
                                                    <div class="media mg-t-20 mg-b-0">
                                                        <img src="<?= base_url() ?>public/upload/zona/<?= $row->file_img; ?>"
                                                            class="d-flex wd-100 rounded-circle mg-r-8" alt="Image">
                                                        <div class="media-body">
                                                        </div><!-- media-body -->
                                                    </div><!-- media -->
                                                </td>
                                                <td><span><?= $row->url; ?></span></td>
                                                <td>
                                                    <span><?= $row->deskripsi; ?></span>
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
                <h5 class="modal-title text-white" id="my-modal-title">Tambah Data Zona Integritas</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="form_zona_integritas" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">File Upload</label>
                                <input type="file" name="file_image" id="file_image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">URL</label>
                                <input type="text" name="url" id="url" class="form-control" placeholder="Masukkan URL">
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" cols="5" rows="5"
                                    class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-md btn-primary button-prevent" onclick="simpan_data_profile()">
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