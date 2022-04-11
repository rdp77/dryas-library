"use strict";
if ($(".rolesId").val() == 1 || $(".rolesId").val() == 2) {
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
            url: "/loan/proposal-loan/proposalLoan",
            type: "GET",
        },
        dom: '<"html5buttons">lBrtip',
        oLanguage: {
            sEmptyTable: "Belum ada data",
        },
        columns: [
            // { data: "DT_RowIndex", orderable: false, searchable: false },
            { data: "code" },
            { data: "dateInput" },
            { data: "memberData" },
            { data: "totalValue" },
            { data: "installmentPeriodName" },
            { data: "description" },
            { data: "reason" },
            { data: "currentStatus" },
            { data: "remainingBill" },
            { data: "action", orderable: false, searchable: true },
        ],

        columnDefs: [
            {
                targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
                className: "text-center",
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
                messageTop:
                    "Dokumen dikeluarkan tanggal " + moment().format("L"),
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
} else {
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
            url: "/loan/proposal-loan/proposalLoan",
            type: "GET",
        },
        dom: '<"html5buttons">lBrtip',
        oLanguage: {
            sEmptyTable: "Belum ada data",
        },
        columns: [
            { data: "dateInput" },
            { data: "memberData" },
            { data: "totalValue" },
            { data: "installmentPeriodName" },
            { data: "description" },
            { data: "reason" },
            { data: "currentStatus" },
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
                messageTop:
                    "Dokumen dikeluarkan tanggal " + moment().format("L"),
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

        columnDefs: [
            {
                targets: [0, 1, 2, 3, 4, 5, 6, 7],
                className: "text-center",
            },
        ],
    });
}

$(".filter_name").on("keyup", function () {
    table.search($(this).val()).draw();
});

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

// InitialloanTotal = total pengajuan pinjaman
// InitialInstallmentPeriod = lama peminjaman
// InitialChargeAdmin = biaya admin
// InitialRates = biaya bunga
// InitialDeposit = tabungan
// InitialInstallmentPrincipal = angsuran pokok

function loanSimulation() {
    var member = $(".memberId").val();
    $.ajax({
        url: "/loan/proposal-loan/check-top-up-proposalLoan",
        type: "POST",
        data: { id: member },
        success: function (data) {
            var totalTopUp = data.total;
            if (totalTopUp != 0) {
                $(".showHideSisaPinjam").css("display", "block");
            } else {
                $(".showHideSisaPinjam").css("display", "none");
            }
            $(".dropHereShowHideSisaPinjam").empty();
            var nun = [];
            var ttlakr = [];
            for (let i = 0; i < data.totalDataDetailProposal.length; i++) {
                for (let j = 0; j < data.checkPayInstallments.length; j++) {
                    if (
                        data.checkPayInstallments[j].installment ==
                        data.totalDataDetailProposal[i].id
                    ) {
                        nun[j] = data.checkPayInstallments[j].real;
                    }
                }

                if (nun[i] == undefined) {
                    ttlakr = 0;
                } else {
                    ttlakr = nun[i];
                }
                var dataRealPembayaran = 0;
                $(".dropHereShowHideSisaPinjam").append(
                    "<tr>" +
                        '<td style="text-align: center;">' +
                        (i + 1) +
                        "</td>" +
                        '<td style="text-align: center;">' +
                        parseInt(
                            data.totalDataDetailProposal[i].total_bill
                        ).toLocaleString() +
                        "</td>" +
                        '<td style="text-align: center;">' +
                        ttlakr +
                        "</td>" +
                        "</tr>"
                );
            }

            if ($(".total").val() == "") {
                var InitialloanTotal = 0;
            } else {
                var noCommas = $(".total").val().replace(/,/g, ""),
                    asANumber = +noCommas;
                var InitialloanTotal = noCommas;
            }
            if (InitialloanTotal != 0) {
                var loanType = "Customer";
                var InitialInstallmentPeriodType = $(".installment")
                    .find(":selected")
                    .data("type");
                var InitialInstallmentPeriod = $(".installment")
                    .find(":selected")
                    .data("range");
                var InitialChargeAdmin = 0;
                var InitialRates = 20;

                if (InitialInstallmentPeriodType == "Bulan") {
                    var dueDate = 30;
                } else {
                    var dueDate = 7;
                }

                if (loanType == "Customer") {
                    var recudedChargeAdmin = 5;
                    var recudedDeposit = 5;
                    var recudedvoluntaryFunds = 0;
                    var recudedFund = 3;
                } else {
                    var recudedChargeAdmin = 3;
                    var recudedDeposit = 2;
                    var recudedvoluntaryFunds = 5;
                    var recudedFund = 2;
                }

                var InitialInstallmentPrincipal =
                    InitialloanTotal / InitialInstallmentPeriod;
                var recudedChargeAdminValue =
                    (InitialloanTotal * recudedChargeAdmin) / 100;
                var recudedDepositValue =
                    (InitialloanTotal * recudedDeposit) / 100;
                var recudedvoluntaryFundsValue =
                    (InitialloanTotal * recudedvoluntaryFunds) / 100;
                var recudedFundValue = (InitialloanTotal * recudedFund) / 100;
                var totalRates = (InitialloanTotal * InitialRates) / 100;
                var totalDisbursement =
                    InitialloanTotal -
                    recudedChargeAdminValue -
                    recudedDepositValue -
                    recudedvoluntaryFundsValue -
                    recudedFundValue -
                    parseInt(totalTopUp);

                if (totalDisbursement < 0) {
                    swal("Anda tidak dapat melakukan Pinjaman", {
                        icon: "warning",
                    });
                }

                $(".dropDisbursement").val(parseInt(totalDisbursement));
                $(".dropDisbursementRupiah").val(
                    parseInt(totalDisbursement).toLocaleString()
                );
                $(".dropChargeAdminValue").val(
                    parseInt(recudedChargeAdminValue)
                );
                $(".dropDepositValue").val(parseInt(recudedDepositValue));
                $(".dropvoluntaryFundsValue").val(
                    parseInt(recudedvoluntaryFundsValue)
                );
                $(".dropFundValue").val(parseInt(recudedFundValue));
                $(".dropRates").val(parseInt(totalRates));

                const currentMoment = moment();
                $(".dropHere").empty();
                for (let index = 0; index < InitialInstallmentPeriod; index++) {
                    currentMoment.add(dueDate, "days");

                    var rates =
                        (InitialInstallmentPrincipal * InitialRates) / 100;
                    var chargeAdmin = InitialChargeAdmin;
                    var installmentPrincipal = InitialInstallmentPrincipal;
                    var bill = Math.round(
                        InitialInstallmentPrincipal + InitialChargeAdmin + rates
                    );

                    $(".dropHere").append(
                        "<tr>" +
                            '   <td style="display:none"><input type="text" name="dueDate[]" value="' +
                            `${currentMoment.format("YYYY-MM-DD")}` +
                            '">' +
                            '   <input type="text" name="installmentPrincipalDetail[]" value="' +
                            parseInt(installmentPrincipal) +
                            '">' +
                            '   <input type="text" name="ratesDetail[]" value="' +
                            parseInt(rates) +
                            '">' +
                            '   <input type="text" name="chargeAdminDetail[]" value="' +
                            parseInt(0) +
                            '">' +
                            '   <input type="text" name="billDetail[]" value="' +
                            parseInt(Math.ceil(bill / 100) * 100) +
                            '"></td>' +
                            '	<td style="text-align: center;">' +
                            (index + 1) +
                            "</td>" +
                            '	<td style="text-align: center;">' +
                            `${currentMoment.format("DD MMMM YYYY")}` +
                            "</td>" +
                            // '	<td style="text-align: center;">'+parseInt(installmentPrincipal).toLocaleString()+'</td>'+
                            // '	<td style="text-align: center;">'+parseInt(rates).toLocaleString()+'</td>'+
                            // '	<td style="text-align: center;">'+0+'</td>'+
                            '	<td style="text-align: center;">' +
                            parseInt(
                                Math.ceil(bill / 100) * 100
                            ).toLocaleString() +
                            "</td>" +
                            "</tr>"
                    );
                }
            }
        },
    });
}

// New Function Save
function save(argument) {
    if (
        $(".memberId").val() == 0 ||
        $(".memberId").val() == null ||
        $(".memberId").val() == ""
    ) {
        return swal("Nama Nasabah belum dipilih", {
            icon: "warning",
        });
    }

    if (
        $(".description").val() == 0 ||
        $(".description").val() == null ||
        $(".description").val() == ""
    ) {
        return swal("Keterangan Harus Di isi", {
            icon: "warning",
        });
    }

    // if ($('#loanType').val() == 0 || $('#loanType').val() == null || $('#loanType').val() == '') {
    //     return swal('Jenis Pinjaman belum dipilih', {
    //         icon: "warning",
    //     });
    // }

    if (
        $("#total").val() == 0 ||
        $("#total").val() == null ||
        $("#total").val() == ""
    ) {
        return swal("Jumlah Pinjaman Harus Di isi", {
            icon: "warning",
        });
    }

    if (
        $("#installment").val() == 0 ||
        $("#installment").val() == null ||
        $("#installment").val() == ""
    ) {
        return swal("Lama Angsuran belum dipilih", {
            icon: "warning",
        });
    }

    swal({
        title: "Apakah Anda Yakin?",
        text: "Data ini akan dikirimkan kepada Manager.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/loan/proposal-loan/proposalLoan",
                data: $(".form-data").serialize(),
                type: "POST",
                success: function (data) {
                    if (data.status == "success") {
                        swal("Pengajuan berhasil diajukan kepada manager", {
                            icon: "success",
                        });
                        // alert(urlRe);
                        window.location.href = data.url;
                        // location.reload();
                    } else if (data.status == "duplicate") {
                        swal(data.message, {
                            icon: "error",
                        });
                    } else {
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
            swal("Data Pengajuan Pinjaman Dibatalkan");
        }
    });
}

function updateData(argument) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menyimpan data Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willSave) => {
        if (willSave) {
            $.ajax({
                url: "/loan/proposal-loan/proposalLoan/" + argument,
                data: $(".form-data").serialize(),
                type: "PUT",
                success: function (data) {
                    if (data.status == "success") {
                        swal("Data Pengajuan Pinjaman Disimpan", {
                            icon: "success",
                        });
                        location.reload();
                    }
                },
                error: function (data) {
                    // edit(id);
                },
            });
        } else {
            swal("Data Pengajuan Pinjaman Berhasil Dihapus!");
        }
    });
}

function saveDataModal() {
    $(".typeModal").empty();
    $(".reason").empty();
    var type = $(".typeModal").val();
    var reason = $(".reason").val();
    var date = $(".dateModal").val();
    var id = $(".idModal").val();

    swal({
        title: "Apakah Anda Yakin?",
        // text: "Aksi ini akan " + type + " pengajuan ini!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            if (type == "Approve") {
                $.ajax({
                    url: "/loan/proposal-loan/approveProposal",
                    data: { id: id, reason: reason, date: date },
                    type: "POST",
                    success: function () {
                        swal("Data Pinjaman Berhasil disetujui", {
                            icon: "success",
                        });
                        $("#exampleModal").modal("hide");
                        table.draw();
                    },
                });
            } else if (type == "Menolak") {
                $.ajax({
                    url: "/loan/proposal-loan/rejectProposal",
                    data: { id: id, reason: reason },
                    type: "POST",
                    success: function () {
                        swal("Data Pinjaman Tidak disetujui", {
                            icon: "success",
                        });
                        $("#exampleModal").modal("hide");
                        table.draw();
                    },
                });
            } else if (type == "Membatalkan") {
                $.ajax({
                    url: "/loan/proposal-loan/canceledProposal",
                    data: { id: id, reason: reason },
                    type: "POST",
                    success: function () {
                        swal("Data Pinjaman Tidak disetujui", {
                            icon: "success",
                        });
                        $("#exampleModal").modal("hide");
                        table.draw();
                    },
                });
            }
            // $('#modal').modal('toggle');
        } else {
            swal("Batal!");
        }
    });
}

function approved(id, type) {
    $(".modal-title").text("Keterangan Persetujuan Kredit");
    $(".hiddenDate").css("display", "block");
    // $(".munculButtonTolak").css("display", "none");
    $(".idModal").val(id);
    $(".typeModal").val(type);
    $(".changeButton").html(
        '<i class="fa fa-check" aria-hidden="true"></i> Setuju'
    );
}

function rejected(id, type) {
    $(".modal-title").text("Keterangan Penolakan Kredit");
    $(".hiddenDate").css("display", "none");
    // $(".munculButtonTolak").css("display", "block");
    $(".idModal").val(id);
    $(".typeModal").val(type);
    $(".changeButton").html(
        '<i class="fa fa-times" aria-hidden="true"></i> Tolak'
    );
}

// function canceled(id, type) {
//     $(".modal-title").text("Keterangan Membatalkan Kredit");
//     $(".hiddenDate").css("display", "none");
//     $(".tolak").css("display", "none");
//     $(".setuju").css("display", "none");
//     $(".idModal").val(id);
//     $(".typeModal").val(type);
// }

function del(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan mem-hapus data pengajuan.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/loan/proposal-loan/proposalLoan/" + id,
                type: "DELETE",
                success: function () {
                    swal("Data pengguna berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data pengguna Anda tidak jadi dihapus!");
        }
    });
}
