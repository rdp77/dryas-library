"use strict";

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});



function searchData(params) {
    $("#dropData").empty();
    // $(".day").text();
    // $(".totalPagu").val(0);
    // $(".dropDataPdl").empty();
    // $(".dropDataProposal").empty();
    // $(".dropDataLoan").empty();
    // $(".dropTotalDataProposal").val(0);
    // $(".dropTotalDataPay").val(0);
    // $(".dropTotalPengembalian").val(0);
    // $(".dropTotalDataPdl").val(0);

    // var typeUser = $(".typeSaveUser").val();
    // $(".buttonSubmitSales").css("display", "none");
    // var dropTotalTagihan = 0;
    // var dropTotalDibayar = 0;
    // var dropTotalSisa = 0;
    // var numbering = 0;
    var filter = $("#dtpickermnth").val();
    // var date1 = $("#dateModal1").val();
    // var date2 = $("#dateModal2").val();
    // swal("Data berhasil Terload", {
    //     icon: "success",
    // });
    $.ajax({
        url: "/report/search-credit-status-report",
        type: "post",
        data: { filter:filter },
        success: function (data) {
            $.each(data.result.html, function (index, value) {
                $("#dropData").append(value);
            });
                    

    // $(".dropDataLoan").empty();
    
    // $.each(data.result.dataLoan, function (index, value) {
    //                 numbering += 1;
    //                 $(".dropDataLoan").append(
    //                     "<tr>" +
    //                         "<td style='text-align: center;'>" +
    //                         numbering +
    //                         "</td>" +
    //                         "<td style='text-align: center;'>" +
    //                         value.code +
    //                         "</td>" +
    //                         "<td style='text-align: center;'>" +
    //                         value.member.name +
    //                         "</td>" +
    //                         "<td style='text-align: center;'>" +
    //                         moment(value.date).format("D-MMM-Y") +
    //                         "</td>" +
    //                         "<td style='text-align: center;'>" +
    //                         data.result.due_date[index] +
    //                         "</td>" +
    //                         "<td style='text-align: center;'>" +
    //                         value.installment.range + ' ' + value.installment.type +
    //                         "</td>" +
    //                         "<td style='text-align: right;'>" +
    //                         parseInt(data.result.ttlpinjaman[index]).toLocaleString() +
    //                         "</td>" +
    //                         "<td style='text-align: right;'>" +
    //                         parseInt(data.result.totalPayment[index]).toLocaleString() +
    //                         "</td>" +
    //                         "<td style='text-align: right;'>" +
    //                         parseInt(data.result.ttlpinjaman[index]-data.result.totalPayment[index]).toLocaleString() +
    //                         "</td>" +
    //                         "</tr>"
    //                 );
    //                 dropTotalTagihan += parseInt(data.result.ttlpinjaman[index]);
    //                 dropTotalDibayar += parseInt(data.result.totalPayment[index]);
    //                 dropTotalSisa += parseInt(data.result.ttlpinjaman[index]-data.result.totalPayment[index]);
                    
    //                 });
    //                 $(".dropTotalTagihan").text(
    //                     parseInt(dropTotalTagihan).toLocaleString()
    //                 );
    //                 $(".dropTotalDibayar").text(
    //                     parseInt(dropTotalDibayar).toLocaleString()
    //                 );
    //                 $(".dropTotalSisa").text(
    //                     parseInt(dropTotalSisa).toLocaleString()
    //                 );
    //                 // console.log(dropTotalSisa);

          
        },
    });
}

// function getval(sel) {
//     if (sel.value == 'Custom') {
//         $('.hiddenTanggal').css('display','block');
//     }else{
//         $('.hiddenTanggal').css('display','none');
//     }
// }
function printData(url) {
    var filter = $("#dtpickermnth").val();
    window.open(url + "/report/print-credit-status-report?&filter=" + filter);
}
