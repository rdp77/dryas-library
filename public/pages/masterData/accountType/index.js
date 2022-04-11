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
        url: url,
        type: "GET",
    },
    dom: '<"html5buttons">lBrtip',
    columns: [
        { data: "DT_RowIndex", orderable: false, searchable: false },
        { data: "code_aktiva" },
        { data: "type_transaction" },
        { data: "account" },
        { data: "income" },
        { data: "spending" },
        { data: "active" },
        { data: "profit" },
        { data: "action", orderable: false, searchable: true },
    ],
    'columnDefs': [
        {
            "targets": [ 0, 1, 2, 3, 4, 5, 6, 7, 8],
            "className": "text-center",
        }
        ],
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
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus Data Jenis Akun Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/data/accountType/" + id,
                type: "DELETE",
                success: function () {
                    swal("Data Jenis Akun berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data Jenis Akun Anda tidak jadi dihapus!");
        }
    });
}

function delRecycle(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus data jenis akun Anda secara permanen.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/temp/accountType/delete/" + id,
                type: "DELETE",
                success: function () {
                    swal("Data jenis akun berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data jenis akun Anda tidak jadi dihapus!");
        }
    });
}

function delAll() {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus semua data jenis akun Anda secara permanen.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/temp/accountType/delete-all",
                type: "DELETE",
                success: function () {
                    swal("Semua data jenis akun berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Semua data jenis akun Anda tidak jadi dihapus!");
        }
    });
}

function restore(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini mengembalikan data jenis akun Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/temp/accountType/restore/" + id,
                type: "GET",
                success: function () {
                    swal("Data jenis akun berhasil dikembalikan", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data jenis akun Anda tidak jadi dikembalikan!");
        }
    });
}
