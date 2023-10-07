function base_url(string_url) {
    var pathparts = location.pathname.split('/');
    if (location.host == 'localhost') {
        var url = location.origin + '/' + pathparts[1].trim('/') + '/' + string_url; // http://localhost/myproject/
    } else {
        var url = location.origin + '/' + string_url; // http://stackoverflow.com
    }
    return url;
}

$(function () {
    'use strict';
    $('#tbl_koleksi').DataTable();
    $('#summernote').summernote();
});

function ShowKategori() {
    $("#my-modal-show-kategori").modal('show');
}

function add_koleksi() {
    $("#my-modal").modal('show');
}

function simpan_data_koleksi() {
    var cmb_kategori = document.getElementById("cmb_kategori");
    var cmb_kategori_value = cmb_kategori.options[cmb_kategori.selectedIndex].value;
    var file_img = document.getElementById("file_img").isDefaultNamespace.length;
    var judul = $("#judul").val();
    var sumber = $("#sumber").val();
    var penulis = $("#penulis").val();
    var tanggal = $("#tanggal").val();
    var formupload = document.getElementById("form_koleksi");
    var summernoteValue = $('#summernote').summernote('code');

    if (cmb_kategori_value == "" || judul == "" || sumber == "" || penulis == "" || tanggal == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Alert',
            text: 'Wajib Mengisi Field - Field Yang Sudah Tersedia !'
        });
    } else if (file_img == 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Alert',
            text: 'Wajib Mengupload File !'
        });
    } else {
        $('.button-prevent').attr('disabled', 'true');
        $('.spinner').show();
        $('.hide-text').hide();
        var formdata = new FormData(formupload);
        formdata.append('summernoteValue', summernoteValue);
        $.ajax({
            url: base_url("usr/koleksi/insert"),
            method: "POST",
            data: formdata,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                if (data.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data Berhasil Disimpan !'
                    });
                    document.location.reload();
                }
            }
        });
    }
}


var app = angular.module('ModuleKategoriKoleksi', ['datatables']);
app.controller('ControllerKategoriKoleksi', function ($scope, $http) {
    function LoadData() {
        $http.get(base_url('usr/koleksi/get_datakategori'))
            .then(function (response) {
                $scope.DataKoleksi = response.data;
                console.log(response.data);
            })
            .catch(function (error) {
                console.error('Terjadi kesalahan:', error);
            });
    }
    LoadData();

    $scope.InsertKategori = function () {
        var data = {
            kategori: $scope.kategori
        };
        $http.post(base_url('usr/koleksi/insert_katagori_koleksi'), data)
            .then(function (response) {
                LoadData();
                $("#kategori").val('');
                ComboKategori();
            })
            .catch(function (error) {
                // Proses gagal
                console.error('Terjadi kesalahan saat menyimpan data:', error);
                // Tampilkan pesan kesalahan kepada pengguna atau lakukan penanganan kesalahan yang sesuai.
            });
    };

    $scope.DeleteKategori = function (dt) {
        var data = {
            id: dt.id
        }; // Menggunakan properti id dari objek kategoriMakanan (sesuaikan dengan properti yang sesuai)
        $http.post(base_url('usr/koleksi/kategori_delete'), data)
            .then(function (response) {
                LoadData();
                ComboKategori();
            })
            .catch(function (error) {
                // Proses hapus gagal
                console.error('Terjadi kesalahan saat menghapus data:', error);
                // Tampilkan pesan kesalahan kepada pengguna atau lakukan penanganan kesalahan yang sesuai.
            });
    }
});

function ComboKategori() {
    fetch(base_url('usr/koleksi/get_datakategori'))
        .then(response => response.json())
        .then(data => {
            const optionsData = data;
            const select = document.getElementById('cmb_kategori');
            select.innerHTML = '';
            // Add the default "Pilih" option
            const defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.text = 'Pilih';
            select.appendChild(defaultOption);

            optionsData.forEach(option => {
                const newOption = document.createElement('option');
                newOption.value = option.kategori;
                newOption.text = option.kategori;
                select.appendChild(newOption);
            });
        })
        .catch(error => console.error(error));
}

ComboKategori()


function DeleteKoleksi(id) {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Anda yakin ingin menghapus Data ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(base_url('usr/koleksi/delete_koleksi'), {
                method: 'POST',
                body: JSON.stringify({ id: id }),
            })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        throw new Error('Gagal menghapus data');
                    }
                })
                .then(data => {
                    if (data.status == "success") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data Berhasil Disimpan !'
                        });
                        document.location.reload();
                    }
                })
                .catch(error => {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Terjadi kesalahan saat menghapus data'
                    });
                });
        }
    });
}

