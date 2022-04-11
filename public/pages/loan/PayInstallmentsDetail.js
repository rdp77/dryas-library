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
    oLanguage: {
        sEmptyTable: "Belum ada data",
    },
    columns: [
        {
            data: "DT_RowIndex",
            orderable: false,
            searchable: false,
            className: "text-center",
        },
        { data: "code", className: "text-center" },
        { data: "pay_date", className: "text-center" },
        // { data: "due_date", className: "text-center" },
        { data: "installment", className: "text-center" },
        // { data: "pay_amount", className: "text-center" },
        // { data: "fine", className: "text-center" },
        { data: "late", className: "text-center" },
        { data: "real", className: "text-center" },
        { data: "created_by", className: "text-center" },
        { data: "status", className: "text-center" },
        { data: "status_loan", className: "text-center" },
        { data: "info", className: "text-center" },
        {
            data: "action",
            className: "text-center",
            orderable: false,
            searchable: true,
        },
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

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function del(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus Data angsuran.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/loan/payInstallments/" + id,
                type: "DELETE",
                success: function () {
                    swal("Data Angsuran berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data Angsuran tidak jadi dihapus!");
        }
    });
}

function delRecycle(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus data angsuran Anda secara permanen.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/loan/pay-installments/temp/delete/" + id,
                type: "DELETE",
                success: function () {
                    swal("Data Angsuran berhasil dihapus secara permanen", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data Angsuran Anda tidak jadi dihapus!");
        }
    });
}

function delAll(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus semua data angsuran Anda secara permanen.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/loan/pay-installments/temp/delete-all/" + id,
                type: "DELETE",
                success: function () {
                    swal("Semua data angsuran berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Semua data angsuran Anda tidak jadi dihapus!");
        }
    });
}

function restore(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini mengembalikan data Angsuran Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/loan/pay-installments/temp/restore/" + id,
                type: "GET",
                success: function () {
                    swal("Data Angsuran berhasil dikembalikan", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data Angsuran Anda tidak jadi dikembalikan!");
        }
    });
}

function showPayOff(id) {
    $.ajax({
        url: "/loan/pay-installments/show-pay/" + id,
        type: "GET",
        success: function (data) {
            $("#loanPrincipal").val(data.result.pokokPinjaman);
            $("#amountTheBill").val(data.result.jumlahTagihan);
            $("#savings").val(data.result.tabungan);
            $("#payOff").modal("show");
        },
    });
}

function payOff(id) {
    $.ajax({
        url: "/loan/pay-installments/paid-off/" + id,
        type: "GET",
        success: function () {
            swal(
                "Terima kasih atas pembayaran Anda. Saat ini Cicilan Anda Telah Lunas",
                {
                    icon: "success",
                }
            ).then(() => {
                location.reload();
            });
        },
    });
}

$("#pay").fireModal({
    title: "Form Pembayaran Angsuran",
    size: "modal-xl",
    body: $("#modal"),
    footerClass: "bg-whitesmoke",
    autoFocus: true,
    onFormSubmit: function (modal, e, form) {
        // // Validator
        // var validation = 0;
        // $(".validation").each(function () {
        //     if (
        //         $(this).val() == "" ||
        //         $(this).val() == null ||
        //         $(this).val() == 0
        //     ) {
        //         validation++;
        //         iziToast.warning({
        //             type: "warning",
        //             title: $(this).data("name"),
        //         });
        //     } else {
        //         validation - 1;
        //     }
        // });
        // Form Data
        let form_data = $(e.target).serialize();
        // DO AJAX HERE
        let fake_ajax = setTimeout(function () {
            form.stopProgress();
            $("[name='real']").val("");
            $("[name='info']").val("");
            $.ajax({
                data: form_data,
                url: payURL,
                type: "POST",
                success: function (data) {
                    if (data.status == "full") {
                        swal(
                            "Penambahan angsuran gagal dikarenakan sisa angsuran sudah selesai",
                            {
                                icon: "error",
                            }
                        );
                    } else if (data.status == "error") {
                        for (var number in data.data) {
                            iziToast.error({
                                title: "Error",
                                position: "center",
                                message: data.data[number],
                            });
                        }
                    } else if (data.status == "paid") {
                        swal(data.data, {
                            icon: "info",
                        });
                    } else {
                        swal(
                            "Pembayaran Angsuran Telah Berhasil. Terima kasih telah melakukan Pembayaran",
                            {
                                icon: "success",
                            }
                        ).then(() => {
                            // document.getElementById("remaining").innerHTML =
                            //     document.getElementById("remaining").innerHTML;
                            // $("#remaining").html("#remaining");
                            // document
                            //     .getElementById("remaining")
                            //     .contentWindow.location.reload(true);
                            // var container =
                            //     document.getElementById("remaining");
                            // var content = container.innerHTML;
                            // container.innerHTML = content;
                            // table.draw();
                            // $("#fire-modal-2").modal("hide");
                            location.reload();
                        });
                    }
                },
            });
            clearInterval(fake_ajax);
        }, 1500);

        e.preventDefault();
    },
    buttons: [
        {
            text: "Bayar Angsuran",
            submit: true,
            class: "btn btn-primary btn-shadow",
            handler: function (modal) {},
        },
    ],
});

$("#pelunasanMdlOp").fireModal({
    title: "Form Pelunasan Angsuran",
    size: "modal-xl",
    body: $("#modalPelunasan"),
    footerClass: "bg-whitesmoke",
    autoFocus: true,
    onFormSubmit: function (modal, e, form) {
        // Validator
        let form_data = $(e.target).serialize();

        var id = $("#pelunasanMdlOp").val();
        // swal({
        //     title: "Apakah Anda Yakin?",
        //     text: "Aksi ini mengubah status angsuran menjadi Lunas",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // }).then((payOff) => {
        //     if (payOff) {
        let fake_ajax = setTimeout(function () {
            form.stopProgress();
            $.ajax({
                url: "/loan/pay-installments/paid-off/" + id,
                type: "GET",
                data: form_data,
                success: function () {
                    swal("Data angsuran berhasil diubah menjadi lunas", {
                        icon: "success",
                    }).then(() => {
                        location.reload();
                    });
                },
            });
            clearInterval(fake_ajax);
        }, 1500);

        e.preventDefault();
        // }
        // });
    },
    buttons: [
        {
            text: "Bayar Pelunasan",
            submit: true,
            class: "btn btn-primary btn-shadow",
            handler: function (modal) {},
        },
    ],
});
