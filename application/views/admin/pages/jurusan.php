<div ng-app="UsrJurusan" ng-controller="UsrJurusanController">
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">
        <div class="br-pageheader">
            <nav class="breadcrumb pd-0 mg-0 tx-12">
                <a class="breadcrumb-item" href="<?= base_url("usr/jurusan") ?>">Jurusan</a>
                <span class="breadcrumb-item active">Daftar Jurusan</span>
            </nav>
        </div><!-- br-pageheader -->
        <div class="br-pagetitle">
            <i class="icon icon ion-ios-photos-outline"></i>
            <div>
                <h4>Informasi Data</h4>
                <p class="mg-b-0">
                    Informasi Data Jurusan SMK Negeri 7 Medan.
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
                                        <button class="btn btn-md btn-primary" ng-click="add_data()" id="btn_add">
                                            <i class="fa fa-plus"></i>
                                            Tambah Data
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="row pt-5">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table datatable="ng" dt-options="vm.dtOptions"
                                            class="table display table-hover nowrap" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>#action</th>
                                                    <th>No</th>
                                                    <th>Nama Jurusan</th>
                                                    <th>File Images</th>
                                                    <th>Deskrispi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr ng-repeat="dt in LoadData" ng-if="LoadData.length > 0">
                                                    <td>
                                                        <div class="button-group">
                                                            <button class="btn btn-sm btn-warning"
                                                                ng-click="ShowEdit(dt)">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        </div>
                                                        <div class="button-group">
                                                            <button class="btn btn-sm btn-danger"
                                                                ng-click="DeleteJurusan(dt)">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td>{{$index + 1}}</td>
                                                    <td>{{dt.nama_jurusan}}</td>
                                                    <td>
                                                        <div class="media mg-t-20 mg-b-0">
                                                            <img src="<?= base_url() ?>public/upload/jurusan/{{dt.file_img}}"
                                                                class="d-flex wd-150 rounded mg-r-1" alt="Image">
                                                            <div class="media-body">
                                                            </div><!-- media-body -->
                                                        </div><!-- media -->
                                                    </td>
                                                    <td>
                                                        {{dt.deskripsi}}
                                                    </td>
                                                </tr>
                                                </td>
                                                </tr>
                                                <tr ng-if="LoadData.length === 0">
                                                    <td colspan="5" class="text-center weight">No data available</td>
                                                </tr>
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

    </div>
    <!-- br-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->


    <!-- Modal Tambah -->
    <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="my-modal-title">Tambah Data</h5>
                    <button class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" id="form_insert_jurusan" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Nama Jurusan</label>
                            <input type="text" name="nama_jurusan" id="nama_jurusan" class="form-control"
                                placeholder="Masukkan Nama Jurusan">
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi</label>
                            <textarea rows="20" cols="20" class="form-control" name="deskripsi"
                                id="summernote"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="">File Image</label>
                            <input type="file" name="file_image" id="file_image" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-md btn-primary button-prevent" ng-click="SimpanDataJurusan()">
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

</div>