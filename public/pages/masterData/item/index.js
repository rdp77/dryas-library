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
        { data: "name" },
        { data: "type" },
        { data: "merk" },
        { data: "price" },
        { data: "total" },
        { data: "info" },
        { data: "action", orderable: false, searchable: true },
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
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus data barang Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/data/item/" + id,
                type: "DELETE",
                success: function () {
                    swal("Data barang berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data barang Anda tidak jadi dihapus!");
        }
    });
}

function delRecycle(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus data barang Anda secara permanen.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/temp/item/delete/" + id,
                type: "DELETE",
                success: function () {
                    swal("Data barang berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data barang Anda tidak jadi dihapus!");
        }
    });
}

function delAll() {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus semua data barang Anda secara permanen.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/temp/item/delete-all",
                type: "DELETE",
                success: function () {
                    swal("Semua data barang berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Semua data barang Anda tidak jadi dihapus!");
        }
    });
}

function restore(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini mengembalikan data barang Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/temp/item/restore/" + id,
                type: "GET",
                success: function () {
                    swal("Data barang berhasil dikembalikan", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data barang Anda tidak jadi dikembalikan!");
        }
    });
}