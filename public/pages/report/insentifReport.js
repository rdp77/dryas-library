"use strict";

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function searchData(type) {
    // Initialization
    $("#dropDataPay").empty();
    $("#dropDataFooter").empty();
    $("#dropData").empty();
    var date1 = $("#dateModal1").val();
    var date2 = $("#dateModal2").val();
    $("#data").removeClass("card-progress-dismiss");
    $("#data2").removeClass("card-progress-dismiss");
    $("#data").addClass("card-progress");
    $("#data2").addClass("card-progress");
    $.ajax({
        url: getData,
        type: "POST",
        data: { date1: date1, date2: date2 },
        success: function (data) {
            if (type == "sales") {
                $("#data").removeClass("card-progress");
                $.each(data.result.html, function (index, value) {
                    $("#dropDataPay").append(value);
                    if (value == data.result.html.length - 1) {
                        $("#dropDataFooter").append(
                            data.result.html[data.result.html.length - 1]
                        );
                        return false;
                    }
                });
                $(".dropInsentifSearch").text(data.result.intensif);
                $(".dropInsentifBerjalan").text(
                    parseInt(data.result.totalInsentifBulanIni).toLocaleString()
                );
            } else if (type == "cashier") {
                // $("#data").removeClass("card-progress");
                // $.each(data.result.html, function (index, value) {
                //     $("#dropDataPay").append(value);
                //     if (value == data.result.html.length - 1) {
                //         $("#dropDataFooter").append(
                //             data.result.html[data.result.html.length - 1]
                //         );
                //         return false;
                //     }
                // });
                $("#data").removeClass("card-progress");
                $("#data2").removeClass("card-progress");
                $.each(data.result.html, function (index, value) {
                    $("#dropData").append(value);
                });
                $.each(data.result.html2, function (index, value) {
                    $("#dropDataPay").append(value);
                });
                $(".dropPenarikan").text(data.result.penarikan);
                $(".dropInsentifBerjalan").text(data.result.insentif_berjalan);
                $(".dropPresentase").text(data.result.ptrh);
            } else if (type == "manager") {
                $("#data").removeClass("card-progress");
                $("#data2").removeClass("card-progress");
                $.each(data.result.html, function (index, value) {
                    $("#dropData").append(value);
                });
                $.each(data.result.html2, function (index, value) {
                    $("#dropDataPay").append(value);
                });
                $(".dropPenarikan").text(data.result.penarikan);
                $(".dropInsentifBerjalan").text(data.result.insentif_berjalan);
                $(".dropPresentase").text(data.result.ptrh);
            }
        },
    });
}
