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
            url: "/loan/proposal-loan/recycle/",
            type: "GET",
        },
        dom: '<"html5buttons">lBrtip',
        columns: [
            // { data: "DT_RowIndex", orderable: false, searchable: false },
            { data: "code" },
            { data: "dateInput" },
            { data: "memberData" },
            { data: "type" },
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
                targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
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
            url: "/loan/proposal-loan/recycle",
            type: "GET",
        },
        dom: '<"html5buttons">lBrtip',
        columns: [
            { data: "dateInput" },
            { data: "type" },
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
        var recudedDepositValue = (InitialloanTotal * recudedDeposit) / 100;
        var recudedvoluntaryFundsValue =
            (InitialloanTotal * recudedvoluntaryFunds) / 100;
        var recudedFundValue = (InitialloanTotal * recudedFund) / 100;
        var totalRates = (InitialloanTotal * InitialRates) / 100;
        var totalDisbursement =
            InitialloanTotal -
            recudedChargeAdminValue -
            recudedDepositValue -
            recudedvoluntaryFundsValue -
            recudedFundValue;

        $(".dropDisbursement").val(parseInt(totalDisbursement));
        $(".dropDisbursementRupiah").val(
            parseInt(totalDisbursement).toLocaleString()
        );
        $(".dropChargeAdminValue").val(parseInt(recudedChargeAdminValue));
        $(".dropDepositValue").val(parseInt(recudedDepositValue));
        $(".dropvoluntaryFundsValue").val(parseInt(recudedvoluntaryFundsValue));
        $(".dropFundValue").val(parseInt(recudedFundValue));
        $(".dropRates").val(parseInt(totalRates));

        const currentMoment = moment();
        $(".dropHere").empty();
        for (let index = 0; index < InitialInstallmentPeriod; index++) {
            currentMoment.add(dueDate, "days");

            var rates = (InitialInstallmentPrincipal * InitialRates) / 100;
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
                    parseInt(Math.ceil(bill / 100) * 100).toLocaleString() +
                    "</td>" +
                    "</tr>"
            );
        }
    }
}

function restore(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini mengembalikan data Pengajuan Pinjaman Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willRestore) => {
        if (willRestore) {
            $.ajax({
                url: "/loan/proposal-loan/restore",
                data: { id: id },
                type: "post",
                success: function () {
                    swal("Data Pengajuan Pinjaman berhasil dikembalikan", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data Pengajuan Pinjaman Anda tidak jadi dikembalikan!");
        }
    });
}

function delRecycle(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus data Pengajuan Pinjaman Anda secara permanen.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/loan/proposal-loan/delete-recycle",
                data: { id: id },
                type: "POST",
                success: function () {
                    swal("Data Pengajuan Pinjaman berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Data Pengajuan Pinjaman Anda tidak jadi dihapus!");
        }
    });
}

function delAll(id) {
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menghapus semua data Pengajuan Pinjaman Anda secara permanen.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            $.ajax({
                url: "/loan/proposal-loan/delete-all",
                data: { id: id },
                type: "POST",
                success: function () {
                    swal("Semua data Pengajuan Pinjaman berhasil dihapus", {
                        icon: "success",
                    });
                    table.draw();
                },
            });
        } else {
            swal("Semua data Pengajuan Pinjaman Anda tidak jadi dihapus!");
        }
    });
}
