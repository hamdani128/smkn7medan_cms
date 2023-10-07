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
    $('#tbl_survei').DataTable();
    $('#summernote').summernote();
});

function add_survei() {
    $("#my-modal").modal('show');
}

function simpan_data_survei() {
    var file = document.getElementById("file_image").files.lenght;
    var tanggal = $("#tanggal").val();
    var judul = $("#judul").val();
    var penulis = $("#penulis").val();
    var formupload = document.getElementById("form_survei");
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
            url: base_url("usr/kegiatan/insert_survei"),
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

function add_agenda() {
    $("#my-modal").modal('show');
}

function simpan_data_agenda() {
    var file = document.getElementById("file_image").files.lenght;
    var tanggal = $("#tanggal").val();
    var judul = $("#judul").val();
    var penulis = $("#penulis").val();
    var formupload = document.getElementById("form_agenda");
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
            url: base_url("usr/kegiatan/insert_agenda"),
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


