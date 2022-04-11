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
        url: "/transaction/credit-funds/creditFunds",
        type: "GET",
    },
    dom: '<"html5buttons">lBrtip',
    "oLanguage": {
        "sEmptyTable": "Belum ada data"
    },
    columns: [
        { data: "DT_RowIndex", orderable: false, searchable: false },
        { data: "sales.name" },
        { data: "liquidDate" },
        { data: "totalValue" },
        { data: "currentStatus" },
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
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus data Dana Pagu Harian Sales Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/transaction/credit-funds/creditFunds/" + id,
                type: "DELETE",
                success: function () {
                    swal("Data Dana Pagu Harian Sales berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data Dana Pagu Harian Sales Anda Batal dihapus!");
        }
    });
}

function save(argument) {

    if ($('.pdl').val() == 0 || $('.pdl').val() == null || $('.pdl').val() == '') {
        return swal('Nama Sales belum dipilih', {
            icon: "warning",
        });
    }

     if ($('.cair').val() == 0 || $('.cair').val() == null || $('.cair').val() == '') {
        return swal('Tanggal belum dipilih', {
            icon: "warning",
        });
    }

     if ($('.total').val() == 0 || $('.total').val() == null || $('.total').val() == '') {
        return swal('Total Pagu belum di isi', {
            icon: "warning",
        });
    }
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan Anda akan memberikan Dana Pagu Harian Sales.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/transaction/credit-funds/creditFunds",
                data: $(".form-data").serialize(),
                type: "POST",
                success: function (data) {
                    if (data.status == "success") {
                        swal("Dana Pagu Harian Sales Berhasil", {
                            icon: "success",
                        });
                        // alert(urlRe);
                        window.location.href = data.url;
                        // location.reload();
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
                url: "/transaction/credit-funds/creditFunds/" + argument,
                data: $(".form-data").serialize(),
                type: "post",
                success: function (data) {
                    if (data.status == "success") {
                        swal("Dana Pagu Harian Sales Berhasil Disimpan", {
                            icon: "success",
                        });
                        // location.reload();
                        // window.history.back();
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
            swal("Data Dana Harian Sales Berhasil Dihapus!");
        }
    });
}


function konfirmasi(id) {
    $.ajax({
        url: "/notificationUpdateStatus",
        data: { id: id },
        type: "get",
        success: function (data) {
            if (data.status == "Success") {
                swal(data.message, {
                    icon: "success",
                });
                // $(".removeThisData" + id).remove();
                location.reload();
            } else {
                swal(data.message, {
                    icon: "danger",
                });
            }
        },
        error: function (data) {
            // edit(id);
        },
    });
}
