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
    $('#tbl_zona').DataTable();
});


function add_zona_integritas() {
    $("#my-modal").modal('show');
}


function simpan_data_profile() {
    var formupload = document.getElementById("form_zona_integritas");
    var url_text = $("#url").val();
    var deskripsi = $("#deskripsi").val();
    var file_data = document.getElementById("file_image").files.length;
    if (url_text == "" || deskripsi == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Alert',
            text: ' Mohon Field - Field yang tersedia wajob diisi!'
        });
    } else if (file_data == 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Alert',
            text: 'Anda Wajib Mengupload File !'
        });
    } else {
        var formData = new FormData(formupload);
        $.ajax({
            url: base_url("usr/zona_integritas/insert"),
            type: 'POST',
            data: formData,
            contentType: false,
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
            },
        });
    }
}