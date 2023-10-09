
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

function Delete_Slider(id) {
    Swal.fire({
        title: 'Konfirmasi',
        text: 'Anda yakin ingin Menghapus Data ini ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Delete',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            var formdata = new FormData();
            formdata.append('id', id);
            fetch(base_url('usr/slider/delete_data'), {
                method: 'POST',
                body: formdata
            }).then(response => response.json()).then(data => {
                if (data.status == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Data Berhasil Terhapus !'
                    });
                    document.location.reload();
                }
            }).catch(error => console.error(error));
        }
    });
}

function Edit_show_Slider(id) {
    var formdata = new FormData();
    formdata.append('id', id);
    fetch(base_url('usr/slider/edit_data_show'), {
        method: 'POST',
        body: formdata
    }).then(response => response.json()).then(data => {
        $("#id_update").val(id);
        $("#my-modal-update").modal('show');
        $("#img_display").attr('src', base_url('public/upload/slider/' + data.data.file_img));
        $("#title_kecil_update").val(data.data.title_kecil)
        $("#title_besar_update").val(data.data.title_besar)
    }).catch(error => console.error(error));
}

function update_date_slider() {
    var form_update = document.getElementById("form_slider_update");
    var formdata = new FormData(form_update);
    fetch(base_url('usr/slider/update_slider'), {
        method: 'POST',
        body: formdata
    }).then(response => response.json()).then(data => {
        if (data.status == 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data Berhasil Terhapus !'
            });
            document.location.reload();
        }
    }).catch(error => console.error(error));
}