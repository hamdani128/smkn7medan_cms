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
    $('#tbl_person').DataTable();
});

function add_person() {
    $("#my-modal").modal('show');
}

function simpan_person() {
    var formupload = document.getElementById("form_insert_person");
    var formData = new FormData(formupload);
    $.ajax({
        url: base_url("usr/person/insert"),
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
                    text: 'Berhasil Disimpan !'
                });
                document.location.reload();
            }
        },
    });
}