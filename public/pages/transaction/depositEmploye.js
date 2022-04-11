"use strict";
var table = $("#table").DataTable({
    pageLength: 10,
    processing: true,
    serverSide: true,
    responsive: true,
    lengthMenu: [
        [10, 25, 50, -1],
        [10, 25, 50, "Semua"],
    ],
    ajax: {
        url: "/transaction/deposit-employe/depositEmploye",
        type: "GET",
    },
    dom: '<"html5buttons">lBrtip',
     "oLanguage": {
        "sEmptyTable": "Belum ada data"
    },
    columns: [
        // { data: "DT_RowIndex", orderable: false, searchable: false },
        { data: "code" },
        { data: "employe.name" },
        { data: "type" },
        { data: "totalValue" },
        { data: "transaction" },
        { data: "created_by" },
        { data: "date" },
        { data: "action", orderable: false, searchable: true },
    ],

    columnDefs: [
        {
            targets: 0, // First Column
            className: "text-center",
            width: "4%",
        },
        {
            targets: [1, 2, 3, 4, 5],
            className: "text-center",
        },
    ],
    // columnDefs: [ {
    //     targets: 2,
    //     render: $.fn.dataTable.render.moment( 'MM/DD/YYYY' )
    // }],
    buttons: [
        {
            extend: "print",
            text: "Print Semua",
            exportOptions: {
                modifier: {
                    selected: null,
                },
                columns: ":visible",
            },
            messageTop: "Dokumen dikeluarkan tanggal " + moment().format("L"),
            // footer: true,
            header: true,
        },
        {
            extend: "csv",
        },
        {
            extend: "print",
            text: "Print Yang Dipilih",
            exportOptions: {
                columns: ":visible",
            },
        },
        {
            extend: "excelHtml5",
            exportOptions: {
                columns: ":visible",
            },
        },
        {
            extend: "pdfHtml5",
            exportOptions: {
                columns: [0, 1, 2, 5],
            },
        },
        {
            extend: "colvis",
            postfixButtons: ["colvisRestore"],
            text: "Sembunyikan Kolom",
        },
    ],
});

$(".filter_name").on("keyup", function () {
    table.search($(this).val()).draw();
});

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function del(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus data Dana Kredit Sales Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/transaction/deposit-employe/depositEmploye/" + id,
                type: "DELETE",
                success: function () {
                    swal("Data Dana Kredit Sales berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data Dana Kredit Sales Anda tidak jadi dihapus!");
        }
    });
}


function save(argument) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menyimpan data Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willSave) => {
        if (willSave) {
            $.ajax({
                url: "/transaction/deposit-employe/depositEmploye",
                data: $(".form-data").serialize(),
                type: "POST",
                success: function (data) {
                    if (data.status == "success") {
                        swal("Data Dana Kredit Sales Berhasil Disimpan", {
                            icon: "success",
                        });
                        // location.reload();
                        window.location.href = data.url;
                    }else{
                        swal(data.message, {
                            icon: "warning",
                        });
                        // location.reload(); 
                    }
                },
                error: function (data) {
                    // edit(id);
                },
            });
        } else {
            swal("Data Dana Kredit Sales Berhasil Dihapus!");
        }
    });
}

function updateData(argument) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan mengupdate data Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willSave) => {
        if (willSave) {
            $.ajax({
                url: "/transaction/deposit-employe/depositEmploye/" + argument,
                data: $(".form-data").serialize(),
                type: "post",
                success: function (data) {
                    swal("Data Dana Kredit Sales Berhasil Disimpan", {
                        icon: "success",
                    });
                    location.reload();
                },
                error: function (data) {
                    // edit(id);
                },
            });
        } else {
            swal("Data Dana Kredit Sales Berhasil Dihapus!");
        }
    });
}
