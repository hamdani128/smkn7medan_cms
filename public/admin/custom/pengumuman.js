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
    $('#tbl_pengumuman').DataTable();
});

function add_pengumuman() {
    $("#my-modal").modal('show');
}

function simpan_data_pengumuman() {
    var formupload = document.getElementById("form_pengumuman");
    var formData = new FormData(formupload);
    var summernoteValue = $('#summernote').summernote('code');
    formData.append('summernoteValue', summernoteValue);
    $.ajax({
        url: base_url("usr/pengumuman/insert"),
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
                    text: 'Pengecekkan Telah Berhasil Silahkan Cek Hasilnya !'
                });
                document.location.reload();
            }
        },
    });
}