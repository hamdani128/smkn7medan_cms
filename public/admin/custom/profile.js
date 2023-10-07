
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
    $('#tbl_profile').DataTable();
});


function add_profile() {
    $("#my-modal").modal('show');
    $('#summernote').summernote();
}

function simpan_data_profile_baru() {
    var formupload = document.getElementById("form_profile");
    var formData = new FormData(formupload);
    var summernoteValue = $('#summernote').summernote('code');
    formData.append('summernoteValue', summernoteValue);
    $.ajax({
        url: base_url("usr/profile/insert"),
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