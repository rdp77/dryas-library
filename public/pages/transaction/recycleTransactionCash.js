"use strict";
var typeIndex = $(".typeIndex").val();
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
        url: "/transaction/recycle/" + typeIndex,
        type: "GET",
    },
    dom: '<"html5buttons">lBrtip',
    columns: [
        { data: "code" },
        { data: "dataDate" },
        { data: "description" },
        { data: "forAccount" },
        { data: "fromAccount" },
        { data: "totalValue" },
        { data: "created_by" },
        { data: "action", orderable: false, searchable: true },
    ],
    columnDefs: [
        {
            targets: 0, // First Column
            className: "text-center",
            width: "5%",
        },
        {
            targets: [1, 2, 3, 4, 5, 6, 7],
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

function restore(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini mengembalikan data Transaksi Kas Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willRestore) => {
        if (willRestore) {
            $.ajax({
                url: "/transaction/restore",
                data: { id: id },
                type: "POST",
                success: function () {
                    swal("Data Transaksi Kas berhasil dikembalikan", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data Transaksi Kas Anda tidak jadi dikembalikan!");
        }
    });
}

function delRecycle(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus data Transaksi Kas Anda secara permanen.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/transaction/delete-recycle",
                data: { id: id },
                type: "POST",
                success: function () {
                    swal("Data Transaksi Kas berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data Transaksi Kas Anda tidak jadi dihapus!");
        }
    });
}

function delAll(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus semua data Transaksi Kas Anda secara permanen.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/transaction/delete-all",
                data: { id: id },
                type: "POST",
                success: function () {
                    swal("Semua data Transaksi Kas berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Semua data Transaksi Kas Anda tidak jadi dihapus!");
        }
    });
}
