"use strict";

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function searchData() {
    // Initialization
    var filter = $("#dtpickermnth").val();
    $("#data").removeClass("card-progress-dismiss");
    $("#data").addClass("card-progress");
    $.ajax({
        url: getData,
        type: "POST",
        data: { filter: filter },
        success: function (data) {
            $("#data").removeClass("card-progress");
            $(".dropSaldoKasSebelumnya").text(data.result.saldoKasSebelumnya);
            $(".dropKasTunai").text(data.result.kasTunai);
            $(".dropKasBesar").text(data.result.kasBesar);
            $(".dropKasBankBni").text(data.result.kasBNI);
            $("#cashBalanceDate").text(data.result.date);
        },
    });
}

function printData(url) {
    // Initialization
    var filter = $("#dtpickermnth").val();
    window.open(url + "/report/print-cash-balance?&filter=" + filter);
}
