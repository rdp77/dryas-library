"use strict";

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function searchDataReport(params) {
    $(".dropDataReport").empty();
    $(".day").text();
    $(".statusReport").val(0);

    var typeUser = $(".typeSaveUser").val();
    $(".buttonSubmitSales").css("display", "none");

    var filter = $("#dtpickermnth").val();
    // swal("Data berhasil Terload", {
    //     icon: "success",
    // });
    $.ajax({
        url: "/search-users-report",
        type: "post",
        data: { filter: filter },
        success: function (data) {
            $(".dropDataReport").empty();
        $.each(data.result.noLaporan, function (index, value) {
        $('.dropDataReport').append(
            "<tr>"+
                "<td>"+data.result.noLaporan[index]+"</td>"+
                "<td>"+moment(data.result.date[index]).format("DD MMMM YYYY")+"</td>"+
                "<td>"+data.result.statusReport[index]+"</td>"+
                "<td><a href='/report/approval-sales-daily-report/"+data.result.id[index]+"' class='btn btn-primary' style='cursor:pointer;'>Lihat</a></td>"+
            "<tr>"
        );
        })
    
            
    },
        error: function(data){
            $(".dropDataReport").append(
                "<tr>" +
                "<td></td>"+
                '<td style="text-align: center;font-weight:bold">'+
                            'Data Tidak Tersedia' +
                "</td>" +
                "<td></td>"+
                "<td></td>"+
                "</tr>"
            );
        }
    });
}
