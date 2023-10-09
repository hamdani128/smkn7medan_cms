
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
    toggleAddButton();
});

function toggleAddButton() {
    var table = document.getElementById('tbl_profile');
    var tbody = table.getElementsByTagName('tbody')[0];
    var addButton = document.getElementById('btn-add-profile');
    if (tbody.rows.length > 0) {
        addButton.style.display = 'none'; // Sembunyikan tombol jika ada baris dalam tabel
    } else {
        addButton.style.display = 'block'; // Tampilkan tombol jika tabel kosong
    }
}

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


function Delete_Profile(id) {
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
            fetch(base_url('usr/profile/delete'), {
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

function Edit_Profile(id) {
    var formdata = new FormData();
    formdata.append('id', id);
    fetch(base_url('usr/profile/show_edit'), {
        method: 'POST',
        body: formdata
    }).then(response => response.json()).then(data => {
        $("#summernote_update").summernote();
        $("#id_update").val(id);
        $("#my-modal-update").modal('show');
        $("#img_display").attr('src', base_url('public/upload/profile/' + data.file_img));
        $("#summernote_update").summernote('code', data.deskripsi);
    }).catch(error => console.error(error));
}

function update_data_profile() {
    var form_update = document.getElementById("form_profile_update");
    var formdata = new FormData(form_update);
    var summernoteValue = $('#summernote_update').summernote('code');
    formdata.append('summernoteValue', summernoteValue);
    fetch(base_url('usr/profile/update_data'), {
        method: 'POST',
        body: formdata
    }).then(response => response.json()).then(data => {
        if (data.status == 'success') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data Berhasil Terupdate !'
            });
            document.location.reload();
        }
    }).catch(error => console.error(error));
}