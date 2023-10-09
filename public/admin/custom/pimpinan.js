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
    $('#tbl_pimpinan').DataTable();
    cekDataPimpinan();
});


function cekDataPimpinan() {
    var table = document.getElementById('tbl_pimpinan');
    var tbody = table.getElementsByTagName('tbody')[0];
    var addButton = document.getElementById('btn-add');

    if (tbody.rows.length > 0) {
        addButton.style.display = 'none'; // Sembunyikan tombol jika ada baris dalam tabel
    } else {
        addButton.style.display = 'block'; // Tampilkan tombol jika tabel kosong
    }
}

function add_pimpinan() {
    $("#my-modal").modal('show');
}


function simpan_data_pimpinan() {
    var formupload = document.getElementById("form_pimpinan");
    var formData = new FormData(formupload);
    // var summernoteValue = $('#summernote').summernote('code');
    // formData.append('summernoteValue', summernoteValue);
    $.ajax({
        url: base_url("usr/pimpinan/insert"),
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
                    text: 'Data Berhasil Di Simpan !'
                });
                document.location.reload();
            }
        },
    });
}

function delete_pimpinan(id, nama) {
    Swal.fire({
        title: 'Apakah Anda ingin Menghapus Data Dengan Nama ' + nama + '  ?',
        text: "Data yang telah terhapus tidak bisa dikembalikan !",
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
                url: base_url('usr/pimpinan/delete_pimpinan'),
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

function edit_pimpinan(id) {
    $.ajax({
        url: base_url('usr/pimpinan/edit_show'),
        type: 'POST',
        data: {
            id: id,
        },
        dataType: "json",
        success: function (data) {
            $("#my-modal-edit").modal('show');
            $("#id_update").val(id);
            $("#pimpinan_update").val(data.nama);
            $("#jabatan_update").val(data.jabatan);
            // Set the text of the file input field
            $("#img_display").attr('src', base_url('public/upload/pimpinan/' + data.file_img));
        }
    });
}


function update_data_pimpinan() {
    var formupload = document.getElementById("form_pimpinan_update");
    var formData = new FormData(formupload);
    $.ajax({
        url: base_url("usr/pimpinan/update_pimpinan"),
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
                    text: 'Data Berhasil Diubah !'
                });
                document.location.reload();
            }
        },
    });
}