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
        url: "/transaction/" + typeIndex,
        type: "GET",
    },
    dom: '<"html5buttons">lBrtip',
     "oLanguage": {
        "sEmptyTable": "Belum ada data"
    },
    columns: [
        { data: "code" },
        { data: "dataDate" },
        { data: "description" },
        { data: "fromAccount" },
        { data: "forAccount" },
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

function del(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus data Transaksi Kas.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/transaction/delete",
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
function save(argument) {
    var url = "/transaction/income/income";
    if (argument == "Pemasukan") {
        var urlRe = "/transaction/Income";
    } else if (argument == "Pengeluaran") {
        var urlRe = "/transaction/Spending";
    } else {
        var urlRe = "/transaction/Transfer";
    }   
    

    if ($('.selectFirst').val() == 0 || $('.selectFirst').val() == null || $('.selectFirst').val() == '') {
        return swal('Dari Akun Harus Di isi', {
            icon: "warning",
        });
    }

    if ($('.selectSecond').val() == 0 || $('.selectSecond').val() == null || $('.selectSecond').val() == '') {
        return swal('Untuk Akun Harus Di isi', {
            icon: "warning",
        });
    }

    if ($('#total').val() == 0 || $('#total').val() == null || $('#total').val() == '') {
        return swal('Total Nilai Harus Di isi', {
            icon: "warning",
        });
    }

    if ($('#description').val() == 0 || $('#description').val() == null || $('#description').val() == '') {
        return swal('Keterangan Harus Di isi', {
            icon: "warning",
        });
    }

    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan Anda akan menyimpan Data ini.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: url,
                data: $(".form-data").serialize(),
                type: "POST",
                success: function (data) {
                    if (data.status == "success") {
                        swal("Data " + argument + " Berhasil Disimpan", {
                            icon: "success",
                        });
                        // alert(urlRe);
                        window.location.href = urlRe;
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

function updateData(argument, argument2) {
    if (argument == "Income") {
        var url = "/transaction/update/" + argument + "/" + argument2;
        var urlRe = "/transaction/Income";
    } else if (argument == "Spending") {        
        var url = "/transaction/update/" + argument + "/" + argument2;
        var urlRe = "/transaction/Spending";
    } else {        
        var url = "/transaction/update/" + argument + "/" + argument2;
        var urlRe = "/transaction/Transfer";
    }        

    if ($('.selectFirst').val() == 0 || $('.selectFirst').val() == null || $('.selectFirst').val() == '') {
        return swal('Dari Akun Harus Di isi', {
            icon: "warning",
        });
    }

    if ($('.selectSecond').val() == 0 || $('.selectSecond').val() == null || $('.selectSecond').val() == '') {
        return swal('Untuk Akun Harus Di isi', {
            icon: "warning",
        });
    }

    if ($('#total').val() == 0 || $('#total').val() == null || $('#total').val() == '') {
        return swal('Total Nilai Harus Di isi', {
            icon: "warning",
        });
    }

    if ($('#description').val() == 0 || $('#description').val() == null || $('#description').val() == '') {
        return swal('Keterangan Harus Di isi', {
            icon: "warning",
        });
    }
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan Anda akan menyimpan Data ini.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: url,
                data: $(".form-data").serialize(),
                type: "POST",
                success: function (data) {
                    if (data.status == "success") {
                        swal("Data " + argument + " Berhasil Disimpan", {
                            icon: "success",
                        });
                        // alert(urlRe);
                        window.location.href = urlRe;
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