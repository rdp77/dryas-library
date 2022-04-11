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

    var typeUser = $(".typeSaveUser").val();
    $(".buttonSubmitSales").css("display", "none");

    var date = $("#dateModal").val();
    // swal("Data berhasil Terload", {
    //     icon: "success",
    // });
    $.ajax({
        url: "/report/search-daily-report",
        type: "post",
        data: { date: date },
        success: function (data) {
            $(".dropTotalBelumDiSub").val(data.result.totalBelumDiSub);

            if (typeUser == "Sales") {
                $(".dropStatusReport").text(data.result.statusReport);
                var dropTotalDataPdl = 0;
                $.each(data.result.dataCreditFunds, function (index, value) {
                    $(".dropDataPdl").append(
                        "<tr>" +
                            '<td style="display:none">' +
                            '<input type="text" value="' +
                            value.code +
                            '" name="pdlCodeDetail[]">' +
                            '<input type="text" value="Pdl" name="pdlTypeDetail[]">' +
                            '<input type="text" value="' +
                            value.total +
                            '" name="pdlTotalDetail[]">' +
                            '<input type="text" value="-" name="pdlDescDetail[]">' +
                            "</td>" +
                            '<td style="text-align: center;">' +
                            parseInt(value.total).toLocaleString() +
                            "</td>" +
                            "</tr>"
                    );

                    dropTotalDataPdl += parseInt(value.total);
                });
                if (
                    data.result.statusReport == "DRAFT" ||
                    data.result.statusReport == "DITOLAK"
                ) {
                    $(".buttonSubmitSales").css("display", "block");
                } else {
                    $(".buttonSubmitSales").css("display", "none");
                }
                $(".dropTotalDataPdl").val(dropTotalDataPdl);
                // console.log(dropTotalDataPdl);

                var dropTotalDataProposal = 0;
                $.each(data.result.dataProposal, function (index, value) {
                    $(".dropDataProposal").append(
                        "<tr>" +
                            '<td style="display:none">' +
                            '<input type="text" value="' +
                            value.code +
                            '" name="proposalCodeDetail[]">' +
                            '<input type="text" value="Pengajuan" name="proposalTypeDetail[]">' +
                            '<input type="text" value="' +
                            value.total_disbursement +
                            '" name="proposalTotalDetail[]">' +
                            '<input type="text" value="-" name="proposalDescDetail[]">' +
                            "</td>" +
                            '<td style="text-align: center;font-weight:bold">' +
                            value.member.name +
                            "</td>" +
                            '<td style="text-align: center;">' +
                            value.member.address +
                            "</td>" +
                            '<td style="text-align: center;font-weight:bold">' +
                            parseInt(value.total).toLocaleString() +
                            "</td>" +
                            '<td style="text-align: center;font-weight:bold">' +
                            parseInt(
                                value.total_disbursement
                            ).toLocaleString() +
                            "</td>" +
                            '<td style="text-align: center;">' +
                            moment(value.review_date).format("DD MMMM YYYY") +
                            "</td>" +
                            '<td style="text-align: center;">' +
                            value.status +
                            "</td>" +
                            '<td style="text-align: center;">' +
                            value.description +
                            "</td>" +
                            "</tr>"
                    );
                    dropTotalDataProposal += parseInt(value.total_disbursement);
                });
                $(".dropTotalDataProposal").val(
                    parseInt(dropTotalDataProposal).toLocaleString()
                );

                var dropTotalDataPay = 0;
                var sisaAngsuranTotal = [];
                $.each(data.result.totalLoan, function (index, value) {
                    sisaAngsuranTotal[index] =
                        value.proposal_loan_detail_sum_total_bill;
                });
                var totalPembayaran = [];
                $.each(data.result.totalPayment, function (index, value) {
                    totalPembayaran[index] = value;
                });
                $.each(data.result.dataPay, function (index, value) {
                    var days =
                        (new Date(value.pay_date) - new Date(value.due_date)) /
                        (1000 * 60 * 60 * 24);
                    console.log(days);
                    if (value.proposal_loan.installment.type == "Minggu") {
                        var jangkaPinjaman = 7 * 3;
                    } else {
                        var jangkaPinjaman = 30 * 3;
                    }

                    var daysTotal = Math.round(days);
                    if (daysTotal <= 0) {
                        var keteranganStatus =
                            '<div class="badge badge-success">Lancar</div>';
                    } else if (daysTotal > 0 && daysTotal < 8) {
                        var keteranganStatus =
                            '<div class="badge badge-warning">Kol 1</div>';
                    } else if (daysTotal > 6 && daysTotal <= jangkaPinjaman) {
                        var keteranganStatus =
                            '<div class="badge badge-warning">Kol 2</div>';
                    } else if (daysTotal > jangkaPinjaman) {
                        var keteranganStatus =
                            '<div class="badge badge-danger">Macet</div>';
                    }

                    $(".dropDataPay").append(
                        "<tr>" +
                            '<td style="display:none">' +
                            '<input type="text" value="' +
                            value.code +
                            '" name="payCodeDetail[]">' +
                            '<input type="text" value="Angsuran" name="payTypeDetail[]">' +
                            '<input type="text" value="' +
                            value.real +
                            '" name="payTotalDetail[]">' +
                            '<input type="text" value="-" name="payDescDetail[]">' +
                            "</td>" +
                            '<td style="text-align: center;font-weight:bold">' +
                            value.proposal_loan.member.name +
                            "</td>" +
                            "<td style='text-align: center;font-weight:bold'>" +
                            value.proposal_loan.member.address +
                            "</td>" +
                            '<td style="text-align: center;font-weight:bold">Cicilan Ke-' +
                            value.installment +
                            " dari (" +
                            value.proposal_loan.installment.range +
                            ")</td>" +
                            "<td style='text-align: center;font-weight:bold'>" +
                            parseInt(value.real).toLocaleString() +
                            "</td>" +
                            "<td style='text-align: center;font-weight:bold'>" +
                            parseInt(
                                sisaAngsuranTotal[index] -
                                    totalPembayaran[index]
                            ).toLocaleString() +
                            "</td>" +
                            "<td style='text-align: center'>" +
                            keteranganStatus +
                            "</td>" +
                            "<td style='text-align: center'>" +
                            value.info +
                            "</td>" +
                            "</tr>"
                    );
                    dropTotalDataPay += parseInt(value.real);
                });
                $(".dropTotalDataPay").val(
                    parseInt(dropTotalDataPay).toLocaleString()
                );

                var totalPrice =
                    parseInt(data.result.total) +
                    parseInt(dropTotalDataPay) -
                    parseInt(dropTotalDataProposal);
                $(".dropTotalPengembalian").val(
                    parseInt(totalPrice).toLocaleString()
                );
                $(".day").text(data.result.day);
                $(".dropDate").text(data.result.date);
                $(".totalPagu").val(
                    parseInt(data.result.total).toLocaleString()
                );
            }

            if (
                data.result.statusReport == "DRAFT" ||
                data.result.statusReport == "DITOLAK"
            ) {
                $(".buttonSubmitCashier").css("display", "block");
            } else {
                $(".buttonSubmitCashier").css("display", "none");
            }
            // KASIR

            $(".dropSaldoKasSebelumnya").text(
                parseInt(data.result.saldoKasSebelumnya).toLocaleString()
            );
            $(".kasTunaiHariIniHariIni").text(
                parseInt(data.result.kasTunaiHariIniHariIni).toLocaleString()
            );
            $(".kasBesarHariIniHariIni").text(
                parseInt(data.result.kasBesarHariIniHariIni).toLocaleString()
            );
            $(".kasBankBniHariIniHariIni").text(
                parseInt(data.result.kasBankBniHariIniHariIni).toLocaleString()
            );
            var totalSaldo = 0;
            $(".dropStatusReport").text(data.result.statusReport);
            $(".dropDataTransaksiKasir").empty();
            $(".dropSales").empty();
            $.each(data.result.dataTrans, function (index, value) {
                // var totalSaldoCredit = parseInt(totalSaldo)+=parseInt(value.total);
                if (value.debet_kredit == "K") {
                    totalSaldo -= parseInt(value.total);
                    var dkTrans =
                        '<td style="text-align: center;">0</td>' +
                        '<td style="text-align: center;">' +
                        parseInt(value.total).toLocaleString() +
                        "</td>";
                    var dkTransCode =
                        '<input type="text" value="K" name="transactionDKDetail[]">';
                } else if (value.debet_kredit == "D") {
                    totalSaldo += parseInt(value.total);
                    var dkTrans =
                        '<td style="text-align: center;">' +
                        parseInt(value.total).toLocaleString() +
                        "</td>" +
                        '<td style="text-align: center;">0</td>';
                    var dkTransCode =
                        '<input type="text" value="D" name="transactionDKDetail[]">';
                } else {
                    totalSaldo += parseInt(value.total);
                    totalSaldo -= parseInt(value.total);
                    var dkTrans =
                        '<td style="text-align: center;">' +
                        parseInt(value.total).toLocaleString() +
                        "</td>" +
                        '<td style="text-align: center;">' +
                        parseInt(value.total).toLocaleString() +
                        "</td>";
                    var dkTransCode =
                        '<input type="text" value="" name="transactionDKDetail[]">';
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
                $(".dropDataTransaksiKasir").append(
                    "<tr>" +
                        '<td style="display:none">' +
                        '<input type="text" value="' +
                        value.code +
                        '" name="transactionCodeDetail[]">' +
                        '<input type="text" value="Transaction" name="transactionTypeDetail[]">' +
                        dkTransCode +
                        '<input type="text" value="' +
                        value.total +
                        '" name="transactionTotalDetail[]">' +
                        '<input type="text" value="' +
                        value.description +
                        '" name="transactionDescDetail[]">' +
                        "</td>" +
                        "<td style='text-align: center'>" +
                        value.code +
                        "</td>" +
                        "<td style='text-align: center'>" +
                        value.account_type.type_transaction +
                        "</td>" +
                        '<td style="text-align: center;">' +
                        value.description +
                        "</td>" +
                        "<td style='text-align: center'>" +
                        fromCash +
                        "</td>" +
                        "<td style='text-align: center'>" +
                        forCash +
                        "</td>" +
                        // '<td>'+moment(value.review_date).format('DD MMMM YYYY')+'</td>'+
                        dkTrans +
                        "<td style='text-align: center'>" +
                        parseInt(totalSaldo).toLocaleString() +
                        "</td>" +
                        "</tr>"
                );
                // }
            });

            // Table untuk menampilkan total Sales
            $.each(data.result.sales, function (index, value) {
                $(".dropData_" + value.id).empty();
                $(".dropSales").append(
                    "<div class='alert alert-success' role='alert'>" +
                        "<h5 class='alert-heading'>Laporan Harian Sales " +
                        value.name +
                        "</h5>" +
                        "<hr>" +
                        "</div>" +
                        '<div class="card-body">' +
                        '<div class="table-responsive">' +
                        '<table class="table-bordered table-hover table" id="table" width="100%">' +
                        "<tr class='bg-secondary'>" +
                        "<th style='text-align: center;'>Jenis Transaksi</th>" +
                        "<th style='text-align: center;'>Keterangan</th>" +
                        "<th style='text-align: center;'>Debet</th>" +
                        "<th style='text-align: center;'>Kredit</th>" +
                        "<th style='text-align: center;'>Saldo</th>" +
                        "</tr>" +
                        '<tbody class="checkDataSales dropData_' +
                        value.id +
                        '">' +
                        "</tbody>" +
                        "<tfoot>" +
                        "<tr>" +
                        "<th> Total Pengembalian : </th>" +
                        '<th style="text-align: center;" class="dropTotalSales_' +
                        value.id +
                        '"></th>' +
                        "</tr>" +
                        "</tfoot>" +
                        "</table>" +
                        "</div>" +
                        "</div>"
                );
            });

            $.each(data.result.dataCreditFunds, function (index, value) {
                $(".dropData_" + value.sales_id).append(
                    "<tr>" +
                        '<td style="display:none">' +
                        '<input type="text" value="' +
                        value.code +
                        '" name="pdlCodeDetail[]">' +
                        '<input type="text" value="Pdl" name="pdlTypeDetail[]">' +
                        '<input type="text" data-sales="' +
                        value.sales_id +
                        '" class="pdlTotalDetail pdlTotalDetail_' +
                        value.sales_id +
                        '" value="' +
                        value.total +
                        '" name="pdlTotalDetail[]">' +
                        '<input type="text" value="' +
                        "Pemberian dana Pagu " +
                        value.sales.name +
                        '" name="pdlDescDetail[]">' +
                        "</td>" +
                        '<td style="text-align: center;">' +
                        "Pemberian dana Pagu</td>" +
                        '<td style="text-align: center;">' +
                        "Pagu " +
                        value.sales.name +
                        "</td>" +
                        '<td style="text-align: center;">' +
                        parseInt(value.total).toLocaleString() +
                        "</td>" +
                        '<td style="text-align: center;">' +
                        0 +
                        "</td>" +
                        '<td style="text-align: center;"><input style="background-color: transparent;border: none;pointer-events: none;cursor: default;" type="text" data-sales="' +
                        value.sales_id +
                        '" class="totalDetailPdlSisaSaldo totalDetailPdlSisaSaldo_' +
                        index +
                        "_" +
                        value.sales_id +
                        '"  name="totalDetailPdlSisaSaldo[]">' +
                        "</td>" +
                        "</tr>"
                );

                if (value.debet_kredit == "K") {
                    totalSaldo -= parseInt(value.total);
                    var dkTrans =
                        '<td style="text-align: center;">0</td>' +
                        '<td style="text-align: center;">' +
                        parseInt(value.total).toLocaleString() +
                        "</td>";
                    var dkTransCode =
                        '<input type="text" value="K" name="transactionDKDetail[]">';
                } else {
                    totalSaldo += parseInt(value.total);
                    var dkTrans =
                        '<td style="text-align: center;">' +
                        parseInt(value.total).toLocaleString() +
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
                $(".dropDataTransaksiKasir").append(
                    "<tr>" +
                        '<td style="display:none">' +
                        '<input type="text" value="' +
                        value.code +
                        '" name="transactionCodeDetail[]">' +
                        '<input type="text" value="Transaction" name="transactionTypeDetail[]">' +
                        dkTransCode +
                        '<input type="text" value="' +
                        value.total +
                        '" name="transactionTotalDetail[]">' +
                        '<input type="text" value="' +
                        "Pemberian Dana Pagu untuk " +
                        value.sales.name +
                        '" name="transactionDescDetail[]">' +
                        "</td>" +
                        '<td style="text-align: center;">' +
                        value.code +
                        "</td>" +
                        '<td style="text-align: center;">' +
                        value.account_type.type_transaction +
                        "</td>" +
                        '<td style="text-align: center;">' +
                        "Pemberian Dana Pagu untuk " +
                        value.sales.name +
                        "</td>" +
                        '<td style="text-align: center;">' +
                        fromCash +
                        "</td>" +
                        '<td style="text-align: center;">' +
                        forCash +
                        "</td>" +
                        // '<td>'+moment(value.review_date).format('DD MMMM YYYY')+'</td>'+
                        dkTrans +
                        '<td style="text-align: center;">' +
                        parseInt(totalSaldo).toLocaleString() +
                        "</td>" +
                        "</tr>"
                );
            });

            $.each(data.result.dataProposal, function (index, value) {
                $(".dropData_" + value.sales_id).append(
                    "<tr>" +
                        '<td style="display:none">' +
                        '<input type="text" value="' +
                        value.code +
                        '" name="proposalCodeDetail[]">' +
                        '<input type="text" value="Pengajuan" name="proposalTypeDetail[]">' +
                        '<input type="text" data-sales="' +
                        value.sales_id +
                        '" class="proposalTotalDetail proposalTotalDetail_' +
                        value.sales_id +
                        '" value="' +
                        value.total_disbursement +
                        '" name="proposalTotalDetail[]">' +
                        '<input type="text" value="' +
                        "Realisasi Kredit " +
                        value.member.name +
                        '" name="proposalDescDetail[]">' +
                        "</td>" +
                        "<td style='text-align: center;'>Realisasi Kredit</td>" +
                        '<td style="text-align: center;">' +
                        "Drop " +
                        value.member.name +
                        "</td>" +
                        '<td style="text-align: center;">' +
                        0 +
                        "</td>" +
                        '<td style="text-align: center;">' +
                        parseInt(value.total_disbursement).toLocaleString() +
                        "</td>" +
                        '<td style="text-align: center;"><input style="background-color: transparent;border: none;pointer-events: none;cursor: default;" type="text" data-sales="' +
                        value.sales_id +
                        '" class="totalDetailPropSisaSaldo totalDetailPropSisaSaldo_' +
                        index +
                        "_" +
                        value.sales_id +
                        '"  name="totalDetailPropSisaSaldo[]">' +
                        "</td>" +
                        "</tr>"
                );
            });

            $.each(data.result.dataPay, function (index, value) {
                if (value.info.includes("Tabungan")) {
                } else {
                    $(".dropData_" + value.sales_id).append(
                        "<tr>" +
                            '<td style="display:none">' +
                            '<input type="text" value="' +
                            value.code +
                            '" name="payCodeDetail[]">' +
                            '<input type="text" value="Angsuran" name="payTypeDetail[]">' +
                            '<input type="text" data-sales="' +
                            value.sales_id +
                            '" class="payTotalDetail payTotalDetail_' +
                            value.sales_id +
                            '" value="' +
                            value.real +
                            '" name="payTotalDetail[]">' +
                            '<input type="text" value="' +
                            "Pembayaran " +
                            value.proposal_loan.member.name +
                            '" name="payDescDetail[]">' +
                            "</td>" +
                            "<td style='text-align: center;'>Angsuran Cicilan</td>" +
                            "<td style='text-align: center;'>Pembayaran " +
                            value.proposal_loan.member.name +
                            "</td>" +
                            '<td style="text-align: center;">' +
                            parseInt(value.real).toLocaleString() +
                            "</td>" +
                            '<td style="text-align: center;">' +
                            0 +
                            "</td>" +
                            '<td style="text-align: center;"><input style="background-color: transparent;border: none;pointer-events: none;cursor: default;" type="text" data-sales="' +
                            value.sales_id +
                            '" class="totalDetailPaySisaSaldo totalDetailPaySisaSaldo_' +
                            index +
                            "_" +
                            value.sales_id +
                            '"  name="totalDetailPaySisaSaldo[]">' +
                            "</td>" +
                            "</tr>"
                    );
                }

                if (value.info.includes("Tabungan")) {
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
                    $(".dropDataTransaksiKasir").append(
                        "<tr>" +
                            '<td style="display:none">' +
                            '<input type="text" value="' +
                            value.code +
                            '" name="transactionCodeDetail[]">' +
                            '<input type="text" value="Transaction" name="transactionTypeDetail[]">' +
                            dkTransCode +
                            '<input type="text" value="' +
                            value.real +
                            '" name="transactionTotalDetail[]">' +
                            '<input type="text" value="' +
                            "Angsuran Cicilan " +
                            value.member.name +
                            '" name="transactionDescDetail[]">' +
                            "</td>" +
                            "<td>" +
                            value.code +
                            "</td>" +
                            "<td style='text-align: center;'>" +
                            "Pembayaran Angsuran" +
                            "</td>" +
                            "<td>" +
                            "Pembayaran Angsuran " +
                            value.proposal_loan.member.name +
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
                }
            });

            // mencari data Debet Pada PDL
            var totalD = [];
            var totalPdl = [];
            $.each($(".pdlTotalDetail"), function (index, value) {
                var sales = $(this).data("sales");
                var salesValue = $(this).val();
                $.each(data.result.sales, function (index1, value1) {
                    if (sales == value1.id) {
                        totalD.push({ id: sales, total: salesValue });
                        totalPdl.push({ id: sales, total: salesValue });
                    }
                });
            });
            var totalK = [];
            var totalProp = [];
            // mencari data Kredit Pada Proposal
            $.each($(".proposalTotalDetail"), function (index, value) {
                var sales = $(this).data("sales");
                var salesValue = $(this).val();
                $.each(data.result.sales, function (index1, value1) {
                    if (sales == value1.id) {
                        totalK.push({ id: sales, total: salesValue });
                        totalProp.push({ id: sales, total: salesValue });
                    }
                });
            });
            var totalPay = [];
            // mencari data Kredit Pada Pembayran
            $.each($(".payTotalDetail"), function (index, value) {
                var sales = $(this).data("sales");
                var salesValue = $(this).val();
                $.each(data.result.sales, function (index1, value1) {
                    if (sales == value1.id) {
                        totalD.push({ id: sales, total: salesValue });
                        totalPay.push({ id: sales, total: salesValue });
                    }
                });
            });

            $.each(data.result.sales, function (index1, value1) {
                // menghitung total akir pengembalian per sales
                var totalssssss = 0;
                var totalPerSales = 0;
                $.each(totalD, function (index, value) {
                    if (value.id == value1.id) {
                        totalssssss += parseInt(value.total);
                    }
                });
                $.each(totalK, function (index2, value2) {
                    if (value2.id == value1.id) {
                        totalssssss -= value2.total;
                    }
                });
                $(".dropTotalSales_" + value1.id).text(
                    parseInt(totalssssss).toLocaleString()
                );
                // menghitung saldo di setiap pdl
                $.each(totalPdl, function (index, value) {
                    if (value.id == value1.id) {
                        totalPerSales += parseInt(value.total);
                        $(
                            ".totalDetailPdlSisaSaldo_" + index + "_" + value.id
                        ).val(parseInt(totalPerSales).toLocaleString());
                    }
                });
                $.each(totalProp, function (index, value) {
                    if (value.id == value1.id) {
                        totalPerSales -= parseInt(value.total);
                        $(
                            ".totalDetailPropSisaSaldo_" +
                                index +
                                "_" +
                                value.id
                        ).val(parseInt(totalPerSales).toLocaleString());
                    }
                });
                $.each(totalPay, function (index, value) {
                    if (value.id == value1.id) {
                        totalPerSales += parseInt(value.total);
                        $(
                            ".totalDetailPaySisaSaldo_" + index + "_" + value.id
                        ).val(parseInt(totalPerSales).toLocaleString());
                    }
                });
            });
        },
    });
}

function submitSales(argument) {
    if ($(".typeSaveUser").val() == "Cashier") {
        if ($(".dropTotalBelumDiSub").val() != 0) {
            return swal(
                "Anda tidak dapat melakukan pengajuan laporan harian karena terdapat laporan sales yang belum diajukan/disetujui",
                {
                    icon: "error",
                }
            );
        }
    }
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menyimpan data Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willSave) => {
        if (willSave) {
            $.ajax({
                url: "/report/submit-sales-daily-report",
                data: $(".form-data").serialize(),
                type: "POST",
                success: function (data) {
                    if (data.status == "success") {
                        swal("Data Report Harian Berhasil Disimpan", {
                            icon: "success",
                        });
                        // setTimeout(function () {
                            location.reload();
                        // }, 10000);
                    } else {
                        swal("Data Report Tidak Bisa Disimpan ", {
                            icon: "error",
                        });
                    }
                },
                error: function (data) {
                    // edit(id);
                },
            });
        } else {
            swal("Laporan Harian Pagu Kredit Sales Berhasil Dibatalkan!");
        }
    });
}
function approvalCashier(params) {
    var id = $(".id").val();
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menyimpan data Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willSave) => {
        if (willSave) {
            $.ajax({
                url: "/report/approval-cashier-daily-report",
                data: { id: id, approval: params },
                type: "POST",
                success: function (data) {
                    if (data.status == "success") {
                        swal("Laporan Harian Berhasil Disimpan", {
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
            swal("Laporan Harian dibatalkan!");
        }
    });
}

function approvalManager(params) {
    var id = $(".id").val();
    swal({
        title: "Apakah Anda Yakin?",
        text: "Aksi ini tidak dapat dikembalikan, dan akan menyimpan data Anda.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willSave) => {
        if (willSave) {
            $.ajax({
                url: "/report/approval-manager-daily-report",
                data: { id: id, approval: params },
                type: "POST",
                success: function (data) {
                    if (data.status == "success") {
                        swal("Data Dana Kredit Sales Berhasil Disimpan", {
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
            swal("Laporan Harian dibatalkan!");
        }
    });
}
