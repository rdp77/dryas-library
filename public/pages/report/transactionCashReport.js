"use strict";

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function searchData(params) {
    $(".dropData").empty();
    $(".day").text();
    $(".totalPagu").val(0);
    $(".dropDataPdl").empty();
    $(".dropDataProposal").empty();
    $(".dropDataPay").empty();
    $(".dropTotalDataProposal").val(0);
    $(".dropTotalDataPay").val(0);
    $(".dropTotalPengembalian").val(0);
    $(".dropTotalDataPdl").val(0);

    // var typeUser = $(".typeSaveUser").val();
    // $(".buttonSubmitSales").css("display", "none");

    var filter = $("#filter").val();
    var date1 = $("#dateModal1").val();
    var date2 = $("#dateModal2").val();
    // swal("Data berhasil Terload", {
    //     icon: "success",
    // });
    $.ajax({
        url: "/report/search-transaction-cash-report",
        type: "post",
        data: { date1: date1, date2: date2, filter: filter },
        success: function (data) {
            // KASIR
            var numbering = 0;
            var totalSaldo = data.result.saldoKasSebelumnya;
            $(".dropData").empty();
            $(".dropSaldoSebelumnya").text(
                parseInt(data.result.saldoKasSebelumnya).toLocaleString()
            );
            $.each(data.result.dataTrans, function (index, value) {
                // var totalSaldoCredit = parseInt(totalSaldo)+=parseInt(value.total);
                numbering += 1;
                if (value.debet_kredit == "K") {
                    totalSaldo -= parseInt(value.total);
                    var dkTrans =
                        '<td style="text-align: center;">0</td>' +
                        '<td style="text-align: right;">' +
                        parseInt(value.total).toLocaleString() +
                        "</td>";
                    // var dkTransCode =
                    // '<input type="text" value="K" name="transactionDKDetail[]" class="transactionDKDetail_"'+value.account_type.id+'>';
                } else {
                    if (
                        value.account_type.type_transaction ==
                        "Transfer Antar Kas"
                    ) {
                        totalSaldo += parseInt(value.total);
                        totalSaldo -= parseInt(value.total);
                        var transfer =
                            '<td style="text-align: right;">' +
                            parseInt(value.total).toLocaleString() +
                            "</td>";
                    } else {
                        var transfer = '<td style="text-align: center;">0</td>';
                        totalSaldo += parseInt(value.total);
                    }
                    var dkTrans =
                        '<td style="text-align: right;">' +
                        parseInt(value.total).toLocaleString() +
                        "</td>" +
                        transfer;
                }
                if (value.from_cash == null) {
                    var fromCash = "-";
                } else {
                    var fromCash = value.from_cash.name;
                }
                if (value.for_cash == null) {
                    var forCash = "-";
                } else {
                    var forCash = value.for_cash.name;
                }
                // if (
                //     value.transaction_type_id == 12 ||
                //     value.transaction_type_id == 3
                // ) {
                $(".dropData").append(
                    "<tr>" +
                        "<td>" +
                        numbering +
                        "</td>" +
                        "<td>" +
                        value.code +
                        "</td>" +
                        "<td><b>" +
                        value.account_type.type_transaction +
                        "</b><br><span>" +
                        value.description +
                        "</span>" +
                        "</td>" +
                        "<td>" +
                        fromCash +
                        "</td>" +
                        "<td>" +
                        forCash +
                        "</td>" +
                        dkTrans +
                        "<td>" +
                        parseInt(totalSaldo).toLocaleString() +
                        "</td>" +
                        "</tr>"
                );
                // }
            });

            $.each(data.result.totalAkhirPengembalian, function (index, value) {
                // var totalSaldoCredit = parseInt(totalSaldo)+=parseInt(value.total);
                numbering += 1;

                // var dkTransCode =
                // '<input type="text" value="K" name="transactionDKDetail[]" class="transactionDKDetail_"'+value.account_type.id+'>';
                totalSaldo += parseInt(value.total);
                var dkTrans =
                    '<td style="text-align: right;">' +
                    parseInt(value.total).toLocaleString() +
                    "</td>" +
                    '<td style="text-align: center;">0</td>';

                // if (
                //     value.transaction_type_id == 12 ||
                //     value.transaction_type_id == 3
                // ) {
                $(".dropData").append(
                    "<tr >" +
                        "<td>" +
                        numbering +
                        "</td>" +
                        "<td>" +
                        value.code +
                        "</td>" +
                        "<td><b>" +
                        value.account +
                        "</b><br><span>" +
                        value.desc +
                        "</span>" +
                        "</td>" +
                        "<td>" +
                        "-" +
                        "</td>" +
                        "<td>" +
                        "Kas Tunai" +
                        "</td>" +
                        dkTrans +
                        "<td>" +
                        parseInt(totalSaldo).toLocaleString() +
                        "</td>" +
                        "</tr>"
                );
                // }
            });

            // $(".totalDataTrans").each(function(index0, value0) {
            //     var total = 0;
            //     $('.transactionDKDetail_' + value.dataset.id).val();
            //     var total = 0;
            //     $('.transactionDKDetail_' + value0.value).each(function(index, value) {
            //         total += parseFloat($('.terlambat_' + value.dataset.id + '_' + value.dataset.tanggal)
            //             .val());
            //         $('.totalKeterlambatan_' + value.dataset.id).text(total.toLocaleString());
            //         $('.totalKeterlambatanRaw_' + value.dataset.id).val(total);
            //     });
            // });

            $.each(data.result.dataPay, function (index, value) {
                numbering += 1;

                if (value.debet_kredit == "K") {
                    // totalSaldo -= parseInt(value.real);
                    var dkTrans =
                        '<td style="text-align: center;">0</td>' +
                        '<td style="text-align: right;">' +
                        parseInt(value.real).toLocaleString() +
                        "</td>";
                    var dkTransCode =
                        '<input type="text" value="K" name="transactionDKDetail[]">';
                } else {
                    totalSaldo += parseInt(value.real);
                    var dkTrans =
                        '<td style="text-align: right;">' +
                        parseInt(value.real).toLocaleString() +
                        "</td>" +
                        '<td style="text-align: center;">0</td>';
                    var dkTransCode =
                        '<input type="text" value="D" name="transactionDKDetail[]">';
                }
                if (value.from_cash == null) {
                    var fromCash = "-";
                } else {
                    var fromCash = value.from_cash.name;
                }
                if (value.for_cash == null) {
                    var forCash = "-";
                } else {
                    var forCash = value.for_cash.name;
                }
                $(".dropData").append(
                    "<tr>" +
                        "<td>" +
                        numbering +
                        "</td>" +
                        "<td>" +
                        value.code +
                        "</td>" +
                        "<td><b>" +
                        value.account_type.type_transaction +
                        "</b><br><span>" +
                        value.info +
                        "</span>" +
                        "</td>" +
                        "<td>" +
                        fromCash +
                        "</td>" +
                        "<td>" +
                        forCash +
                        "</td>" +
                        // '<td>'+moment(value.review_date).format('DD MMMM YYYY')+'</td>'+
                        dkTrans +
                        "<td>" +
                        parseInt(totalSaldo).toLocaleString() +
                        "</td>" +
                        "</tr>"
                );
            });

            $.each(data.result.dataCreditFunds, function (index, value) {
                numbering += 1;
                if (value.debet_kredit == "K") {
                    totalSaldo -= parseInt(value.total);
                    var dkTrans =
                        '<td style="text-align: center;">0</td>' +
                        '<td style="text-align: right;">' +
                        parseInt(value.total).toLocaleString() +
                        "</td>";
                } else {
                    totalSaldo += parseInt(value.total);
                    // console.log(totalSaldo);
                    var dkTrans =
                        '<td style="text-align: right;">' +
                        parseInt(value.total).toLocaleString() +
                        "</td>" +
                        '<td style="text-align: center;">0</td>';
                }
                if (value.from_cash == null) {
                    var fromCash = "-";
                } else {
                    var fromCash = value.from_cash.name;
                }
                if (value.for_cash == null) {
                    var forCash = "-";
                } else {
                    var forCash = value.for_cash.name;
                }
                $(".dropData").append(
                    "<tr>" +
                        "<td>" +
                        numbering +
                        "</td>" +
                        "<td>" +
                        value.code +
                        "</td>" +
                        "<td><b>" +
                        // moment(value.liquid_date).format('DD MMMM YYYY') +
                        value.account_type.type_transaction +
                        "</b><br>Pagu " +
                        value.sales.name +
                        "</td>" +
                        "<td>" +
                        fromCash +
                        "</td>" +
                        "<td>" +
                        forCash +
                        "</td>" +
                        // '<td>'+moment(value.review_date).format('DD MMMM YYYY')+'</td>'+
                        dkTrans +
                        "<td>" +
                        parseInt(totalSaldo).toLocaleString() +
                        "</td>" +
                        "</tr>"
                );
            });

            $.each(data.result.dataProposal, function (index, value) {
                numbering += 1;
                if (value.debet_kredit == "K") {
                    // totalSaldo -= parseInt(value.total_disbursement);
                    var dkTrans =
                        '<td style="text-align: center;">0</td>' +
                        '<td style="text-align: right;">' +
                        parseInt(value.total_disbursement).toLocaleString() +
                        "</td>";
                } else {
                    totalSaldo += parseInt(value.total_disbursement);
                    var dkTrans =
                        '<td style="text-align: right;">' +
                        parseInt(value.total_disbursement).toLocaleString() +
                        "</td>" +
                        '<td style="text-align: center;">0</td>';
                }
                if (value.from_cash == null) {
                    var fromCash = "-";
                } else {
                    var fromCash = value.from_cash.name;
                }
                if (value.for_cash == null) {
                    var forCash = "-";
                } else {
                    var forCash = value.for_cash.name;
                }
                $(".dropData").append(
                    "<tr>" +
                        "<td>" +
                        numbering +
                        "</td>" +
                        "<td>" +
                        value.code +
                        "</td>" +
                        "<td><b>" +
                        // moment(value.liquid_date).format('DD MMMM YYYY') +
                        value.account_type.type_transaction +
                        "</b><br>Peminjaman " +
                        value.member.name +
                        "</td>" +
                        "<td>" +
                        fromCash +
                        "</td>" +
                        "<td>" +
                        forCash +
                        "</td>" +
                        // '<td>'+moment(value.review_date).format('DD MMMM YYYY')+'</td>'+
                        dkTrans +
                        "<td>" +
                        parseInt(totalSaldo).toLocaleString() +
                        "</td>" +
                        "</tr>"
                );
            });
        },
    });
}

function getval(sel) {
    if (sel.value == "Custom") {
        $(".hiddenTanggal").css("display", "block");
    } else {
        $(".hiddenTanggal").css("display", "none");
    }
}
function cetakData(params) {
    var filter = $("#filter").val();
    var date1 = $("#dateModal1").val();
    var date2 = $("#dateModal2").val();
    window.open(
        params +
            "/report/print-transaction-cash-report?&filter=" +
            filter +
            "&date1=" +
            date1 +
            "&date2=" +
            date2
    );
}
