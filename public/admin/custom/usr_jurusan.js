function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}
var app = angular.module('UsrJurusan', ['datatables']);

app.controller('UsrJurusanController', function ($scope, $http) {

    $scope.add_data = function () {
        $("#my-modal").modal('show');
    }
    $scope.LoadDataJurusan = function () {
        $http.get(base_url('usr/jurusan/getdata'))
            .then(function (response) {
                // Menampilkan data halaman pertama saat data diterima
                $scope.LoadData = response.data;
            })
            .catch(function (error) {
                console.error('Terjadi kesalahan:', error);
            });
    }

    $scope.LoadDataJurusan();


    $scope.SimpanDataJurusan = function () {
        var nama_jurusan = $("#nama_jurusan").val();
        var deskripsi = $('#summernote').summernote('code');
        var file_img = document.getElementById('file_image');

        if (nama_jurusan == "" || deskripsi == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Alert !',
                text: 'Wajib Mengisi Seluruh Field Yang Tersedia!'
            });
        } else if (file_img.files.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Alert !',
                text: 'Wajib Mengunggah File!'
            });
        } else {
            var form_update = document.getElementById("form_insert_jurusan");
            var formdata = new FormData(form_update);
            var summernoteValue = $('#summernote').summernote('code');
            formdata.append('summernoteValue', summernoteValue);
            fetch(base_url('usr/jurusan/insert_data'), {
                method: 'POST',
                body: formdata
            }).then(response => response.json()).then(data => {
                if (data.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data Berhasil Tersimpan !'
                    });
                    document.location.reload();
                }
            }).catch(error => console.error(error));
        }
    }

    $scope.DeleteJurusan = function (dt) {
        Swal.fire({
            title: 'Apakah Anda ingin Menghapus Data Jurusan ' + dt.nama_jurusan + '  ?',
            text: "Data yang telah terhapus tidak bisa dikembalikan !",
            type: 'warning',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus !',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                var formdata = new FormData();
                formdata.append('id', dt.id);
                fetch(base_url('usr/jurusan/delete_jurusan'), {
                    method: 'POST',
                    body: formdata
                }).then(response => response.json()).then(data => {
                    if (data.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data Berhasil Tersimpan !'
                        });
                        document.location.reload();
                    }
                }).catch(error => console.error(error));
            }
        });
    }


});