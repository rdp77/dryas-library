"use strict";

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function searchData(params) {
    $(".dropData").empty();
    $(".dropDataBni").empty();
    $(".dropDataBesar").empty();
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

    var filter = $("#dtpickermnth").val();
    // var date1 = $("#dateModal1").val();
    // var date2 = $("#dateModal2").val();
    // swal("Data berhasil Terload", {
    //     icon: "success",
    // });
    $.ajax({
        url: "/report/search-ledger-report",
        type: "post",
        data: { filter: filter },
        success: function (data) {
            // KASIR
            var numbering = 0;
            var numbering1 = 0;
            var numbering2 = 0;
            var totalSaldo = 0;
            var totalSaldo1 = 0;
            var totalSaldo2 = 0;
            $(".dropData").empty();
            $(".dropDataBni").empty();
            $(".dropDataBesar").empty();
            // $('.dropSaldoSebelumnya').text(parseInt(data.result.saldoKasSebelumnya).toLocaleString());
            $.each(data.result.dataTransactionCashKasD, function (index, value) {
                console.log(value.code);
                // var totalSaldoCredit = parseInt(totalSaldo)+=parseInt(value.total);
                numbering += 1;
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
                if (value.debet_kredit == "K") {
                    totalSaldo -= parseInt(value.total);
                    var dkTrans =
                        '<td style="text-align: center;">0</td>' +
                        '<td style="text-align: right;">' +
                        parseInt(value.total).toLocaleString() +
                        "</td>";
                } else {
                    if (
                        value.account_type.type_transaction ==
                        "Transfer Antar Kas"
                    ) {
                        if (fromCash == "Kas Tunai") {
                            totalSaldo -= parseInt(value.total);
                            var transfer =
                                '<td style="text-align: right;">' +
                                parseInt(value.total).toLocaleString() +
                                "</td>";
                            var transfer2 =
                                '<td style="text-align: center;">' +
                                0 +
                                "</td>";
                        } else {
                            totalSaldo += parseInt(value.total);
                            var transfer =
                                '<td style="text-align: center;">' +
                                0 +
                                "</td>";
                            var transfer2 =
                                '<td style="text-align: right;">' +
                                parseInt(value.total).toLocaleString() +
                                "</td>";
                        }
                    } else {
                        totalSaldo += parseInt(value.total);
                        var transfer =
                            '<td style="text-align: center;">' + 0 + "</td>";
                        var transfer2 =
                            '<td style="text-align: right;">' +
                            parseInt(value.total).toLocaleString() +
                            "</td>";
                    }
                    var dkTrans = transfer2 + transfer;
                }

                $(".dropData").append(
                    "<tr>" +
                        "<td style='text-align: center;'>" +
                        numbering +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        value.code +
                        "</td>" +
                        "<td><b>" +
                        value.account_type.type_transaction +
                        "</b><br><span>" +
                        value.description +
                        "</span>" +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        fromCash +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        forCash +
                        "</td>" +
                        // '<td>'+moment(value.review_date).format('DD MMMM YYYY')+'</td>'+
                        dkTrans +
                        "<td style='text-align: right;'>" +
                        parseInt(totalSaldo).toLocaleString() +
                        "</td>" +
                        "</tr>"
                );
            });
            $.each(data.result.dataTransactionCashKasK, function (index, value) {
                // var totalSaldoCredit = parseInt(totalSaldo)+=parseInt(value.total);
                numbering += 1;
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
                if (value.debet_kredit == "K") {
                    totalSaldo -= parseInt(value.total);
                    var dkTrans =
                        '<td style="text-align: center;">0</td>' +
                        '<td style="text-align: right;">' +
                        parseInt(value.total).toLocaleString() +
                        "</td>";
                } else {
                    if (
                        value.account_type.type_transaction ==
                        "Transfer Antar Kas"
                    ) {
                        if (fromCash == "Kas Tunai") {
                            totalSaldo -= parseInt(value.total);
                            var transfer =
                                '<td style="text-align: right;">' +
                                parseInt(value.total).toLocaleString() +
                                "</td>";
                            var transfer2 =
                                '<td style="text-align: center;">' +
                                0 +
                                "</td>";
                        } else {
                            totalSaldo += parseInt(value.total);
                            var transfer =
                                '<td style="text-align: center;">' +
                                0 +
                                "</td>";
                            var transfer2 =
                                '<td style="text-align: right;">' +
                                parseInt(value.total).toLocaleString() +
                                "</td>";
                        }
                    } else {
                        totalSaldo += parseInt(value.total);
                        var transfer =
                            '<td style="text-align: center;">' + 0 + "</td>";
                        var transfer2 =
                            '<td style="text-align: right;">' +
                            parseInt(value.total).toLocaleString() +
                            "</td>";
                    }
                    var dkTrans = transfer2 + transfer;
                }

                $(".dropData").append(
                    "<tr>" +
                        "<td style='text-align: center;'>" +
                        numbering +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        value.code +
                        "</td>" +
                        "<td><b>" +
                        value.account_type.type_transaction +
                        "</b><br><span>" +
                        value.description +
                        "</span>" +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        fromCash +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        forCash +
                        "</td>" +
                        // '<td>'+moment(value.review_date).format('DD MMMM YYYY')+'</td>'+
                        dkTrans +
                        "<td style='text-align: right;'>" +
                        parseInt(totalSaldo).toLocaleString() +
                        "</td>" +
                        "</tr>"
                );
            });
            

            $.each(
                data.result.dataTransactionCashBesar,
                function (index, value) {
                    // var totalSaldoCredit = parseInt(totalSaldo)+=parseInt(value.total);
                    numbering1 += 1;
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
                    if (value.debet_kredit == "K") {
                        totalSaldo1 -= parseInt(value.total);
                        var dkTrans =
                            '<td style="text-align: center;">0</td>' +
                            '<td style="text-align: right;">' +
                            parseInt(value.total).toLocaleString() +
                            "</td>";
                    } else {
                        if (
                            value.account_type.type_transaction ==
                            "Transfer Antar Kas"
                        ) {
                            if (fromCash == "Kas Besar") {
                                totalSaldo1 -= parseInt(value.total);
                                var transfer =
                                    '<td style="text-align: right;">' +
                                    parseInt(value.total).toLocaleString() +
                                    "</td>";
                                var transfer2 =
                                    '<td style="text-align: center;">' +
                                    0 +
                                    "</td>";
                            } else {
                                totalSaldo1 += parseInt(value.total);
                                var transfer =
                                    '<td style="text-align: center;">' +
                                    0 +
                                    "</td>";
                                var transfer2 =
                                    '<td style="text-align: right;">' +
                                    parseInt(value.total).toLocaleString() +
                                    "</td>";
                            }
                        } else {
                            totalSaldo1 += parseInt(value.total);
                            var transfer =
                                '<td style="text-align: center;">' +
                                0 +
                                "</td>";
                            var transfer2 =
                                '<td style="text-align: right;">' +
                                parseInt(value.total).toLocaleString() +
                                "</td>";
                        }
                        var dkTrans = transfer2 + transfer;
                    }
                    $(".dropDataBesar").append(
                        "<tr>" +
                            "<td style='text-align: center;'>" +
                            numbering1 +
                            "</td>" +
                            "<td style='text-align: center;'>" +
                            value.code +
                            "</td>" +
                            "<td><b>" +
                            value.account_type.type_transaction +
                            "</b><br><span>" +
                            value.description +
                            "</span>" +
                            "</td>" +
                            "<td style='text-align: center;'>" +
                            fromCash +
                            "</td>" +
                            "<td style='text-align: center;'>" +
                            forCash +
                            "</td>" +
                            // '<td>'+moment(value.review_date).format('DD MMMM YYYY')+'</td>'+
                            dkTrans +
                            "<td style='text-align: right;'>" +
                            parseInt(totalSaldo1).toLocaleString() +
                            "</td>" +
                            "</tr>"
                    );
                }
            );
            $(".dropDataBesarFoot").html(
                "<tr>" +
                    // "<td colspan='7'>Saldo Akhir</td>" +
                    "<td style='text-align: right;'>" +
                    parseInt(totalSaldo1).toLocaleString() +
                    "</td>" +
                "</tr>"
            );

            $.each(data.result.dataTransactionCashBNI, function (index, value) {
                // var totalSaldoCredit = parseInt(totalSaldo)+=parseInt(value.total);
                numbering2 += 1;
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
                if (value.debet_kredit == "K") {
                    totalSaldo2 -= parseInt(value.total);
                    var dkTrans =
                        '<td style="text-align: center;">0</td>' +
                        '<td style="text-align: right;">' +
                        parseInt(value.total).toLocaleString() +
                        "</td>";
                } else {
                    if (
                        value.account_type.type_transaction ==
                        "Transfer Antar Kas"
                    ) {
                        if (fromCash == "Bank BNI") {
                            totalSaldo2 -= parseInt(value.total);
                            var transfer =
                                '<td style="text-align: right;">' +
                                parseInt(value.total).toLocaleString() +
                                "</td>";
                            var transfer2 =
                                '<td style="text-align: center;">' +
                                0 +
                                "</td>";
                        } else {
                            totalSaldo2 += parseInt(value.total);
                            var transfer =
                                '<td style="text-align: center;">' +
                                0 +
                                "</td>";
                            var transfer2 =
                                '<td style="text-align: right;">' +
                                parseInt(value.total).toLocaleString() +
                                "</td>";
                        }
                    } else {
                        totalSaldo2 += parseInt(value.total);
                        var transfer =
                            '<td style="text-align: center;">' + 0 + "</td>";
                        var transfer2 =
                            '<td style="text-align: right;">' +
                            parseInt(value.total).toLocaleString() +
                            "</td>";
                    }
                    var dkTrans = transfer2 + transfer;
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
                $(".dropDataBni").append(
                    "<tr>" +
                        "<td style='text-align: center;'>" +
                        numbering2 +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        value.code +
                        "</td>" +
                        "<td><b>" +
                        value.account_type.type_transaction +
                        "</b><br><span>" +
                        value.description +
                        "</span>" +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        fromCash +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        forCash +
                        "</td>" +
                        // '<td>'+moment(value.review_date).format('DD MMMM YYYY')+'</td>'+
                        dkTrans +
                        "<td style='text-align: right;'>" +
                        parseInt(totalSaldo2).toLocaleString() +
                        "</td>" +
                        "</tr>"
                );
            });
            $(".dropDataBniFoot").html(
                "<tr>" +
                    // "<td colspan='7'>Saldo Akhir</td>" +
                    "<td style='text-align: right;'>" +
                    parseInt(totalSaldo2).toLocaleString() +
                    "</td>" +
                "</tr>"
            );

            $.each(data.result.dataPay, function (index, value) {
                numbering += 1;

                if (value.debet_kredit == "K") {
                    totalSaldo -= parseInt(value.real);
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
                        "<td style='text-align: center;'>" +
                        numbering +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        value.code +
                        "</td>" +
                        "<td><b>" +
                        value.account_type.type_transaction +
                        "</b><br><span>" +
                        value.info +
                        "</span>" +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        fromCash +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        "Kas Tunai" +
                        "</td>" +
                        // '<td>'+moment(value.review_date).format('DD MMMM YYYY')+'</td>'+
                        dkTrans +
                        "<td style='text-align: right;'>" +
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
                        "<td style='text-align: center;'>" +
                        numbering +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        value.code +
                        "</td>" +
                        "<td><b>" +
                        // moment(value.liquid_date).format('DD MMMM YYYY') +
                        value.account_type.type_transaction +
                        "</b><br>Pagu " +
                        value.sales.name +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        fromCash +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        forCash +
                        "</td>" +
                        // '<td>'+moment(value.review_date).format('DD MMMM YYYY')+'</td>'+
                        dkTrans +
                        "<td style='text-align: right;'>" +
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
                        "<td style='text-align: center;'>" +
                        numbering +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        value.code +
                        "</td>" +
                        "<td ><b>" +
                        // moment(value.liquid_date).format('DD MMMM YYYY') +
                        value.account_type.type_transaction +
                        "</b><br>Peminjaman " +
                        value.member.name +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        fromCash +
                        "</td>" +
                        "<td style='text-align: center;'>" +
                        forCash +
                        "</td>" +
                        // '<td>'+moment(value.review_date).format('DD MMMM YYYY')+'</td>'+
                        dkTrans +
                        "<td style='text-align: right;'>" +
                        parseInt(totalSaldo).toLocaleString() +
                        "</td>" +
                        "</tr>"
                );
            });
            $.each(data.result.totalAkhirPengembalian, function (index, value) {
                // var totalSaldoCredit = parseInt(totalSaldo)+=parseInt(value.total);
                numbering += 1;
                
                    // var dkTransCode =
                        // '<input type="text" value="K" name="transactionDKDetail[]" class="transactionDKDetail_"'+value.account_type.id+'>';
                totalSaldo += parseInt(value.total);
                var dkTrans =
                '<td style="text-align: right;">'+parseInt(value.total).toLocaleString()+'</td>' +
                '<td style="text-align: center;">0</td>';

                    
                // if (
                //     value.transaction_type_id == 12 ||
                //     value.transaction_type_id == 3
                // ) {
                    $(".dropData").append(
                        "<tr >" +
                            "<td style='text-align: center;'>" +
                            numbering +
                            "</td>" +
                            "<td style='text-align: center;'>" +
                            value.code +
                            "</td>" +
                            "<td><b>" +
                            value.account +
                            '</b><br><span>'+value.desc+'</span>'+
                            "</td>" +
                            "<td>" +
                            '-' +
                            "</td>" +
                            "<td>" +
                            'Kas Tunai' +
                            "</td>" +
                            dkTrans +
                            "<td style='text-align: right;'>" +
                            parseInt(totalSaldo).toLocaleString() +
                            "</td>" +
                            "</tr>"
                    );
                // }
            });
            $(".dropDataFoot").html(
                "<tr>" +
                    // "<td colspan='7'>Saldo Akhir</td>" +
                    "<td style='text-align: right;'>" +
                    parseInt(totalSaldo).toLocaleString() +
                    "</td>" +
                "</tr>"
            );
            $(".dropTotalAkhir").text(
                parseInt(
                    totalSaldo + totalSaldo1 + totalSaldo2
                ).toLocaleString()
            );
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
    var filter = $("#dtpickermnth").val();
    // var date1 = $("#dateModal1").val();
    // var date2 = $("#dateModal2").val();
    window.open(
        params +
            "/report/print-ledger-report?&filter=" +
            filter 
            // "&date1=" +
            // date1 +
            // "&date2=" +
            // date2
    );
}
