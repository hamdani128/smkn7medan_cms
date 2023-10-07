
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
    $('#tbl_kegiatan').DataTable();
});

function add_kegiatan() {
    $("#my-modal").modal('show');
}

function add_video() {
    $("#my-modal").modal('show');
}




function simpan_data_kegiatan() {
    var file = document.getElementById("file_image").files.lenght;
    var tanggal = $("#tanggal").val();
    var judul = $("#judul").val();
    var penulis = $("#penulis").val();
    var formupload = document.getElementById("form_kegiatan");
    var summernoteValue = $('#summernote').summernote('code');
    if (tanggal == "" || judul == "" || penulis == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Alert',
            text: 'Wajib Mengisi Field - Field Yang Sudah Tersedia !'
        });
    } else if (file == 0) {
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
            url: base_url("usr/galeri/insert_kegiatan"),
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

function delete_kegiatan(id, tanggal, judul) {
    Swal.fire({
        title: 'Apakah Anda ingin Menghapus Data Dengan Tanggal Publish ' + tanggal + ' dengan Data Judul ' + judul + ' ?',
        text: "Data Pegawai akan diaktifkan !",
        type: 'warning',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus !',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: base_url('usr/galeri/delete_kegiatan'),
                type: 'POST',
                data: {
                    id: id,
                },
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        Swal.fire(
                            'Good Luck !',
                            'Data Berhasil Terhapus !',
                            'success'
                        )
                        window.location.reload();
                    }
                }
            });
        }
    });
}


function simpan_data_video() {
    var file = document.getElementById("file_image").files.lenght;
    var tanggal = $("#tanggal").val();
    var judul = $("#judul").val();
    var penulis = $("#penulis").val();
    var formupload = document.getElementById("form_video");
    var summernoteValue = $('#summernote').summernote('code');
    if (tanggal == "" || judul == "" || penulis == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Alert',
            text: 'Wajib Mengisi Field - Field Yang Sudah Tersedia !'
        });
    } else if (file == 0) {
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
            url: base_url("usr/galeri/insert_video"),
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