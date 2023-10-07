
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
    $('#tbl_slider').DataTable();
});

function add_slider() {
    $("#my-modal").modal("show");
}


function Simpan_data_slider() {
    var title_kecil = $("#title_kecil").val();
    var title_besar = $("#title_besar").val();
    var formupload = document.getElementById("form_slider");
    if (title_kecil == "" || title_besar == "") {
        Swal.fire({
            icon: 'warning',
            title: 'Alert Error',
            text: 'Mohon Maaf, Anda Wajib Mengisi Field - Field Tersedia !'
        });
    } else {
        $('.button-prevent').attr('disabled', 'true');
        $('.spinner').show();
        $('.hide-text').hide();
        var formdata = new FormData(formupload);
        $.ajax({
            url: base_url('usr/slider/simpan'),
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
                        text: 'Pengecekkan Telah Berhasil Silahkan Cek Hasilnya !'
                    });
                    document.location.reload();
                }
            }
        });
    }
}