"use strict";

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function searchData() {
    // Initialization
    var filter = $("#date").val();
    $("#data").removeClass("card-progress-dismiss");
    $("#data").addClass("card-progress");
    $.ajax({
        url: getData,
        type: "POST",
        data: { filter: filter },
        success: function (data) {
            $("#data").removeClass("card-progress");
            $("#profitLossDate").text(data.result.date);
            $("#jumlahPinjaman").text(data.result.jumlahPinjaman);
            $("#pendapatanBiayaAdministrasi").text(
                data.result.pendapatanBiayaAdministrasi
            );
            $("#pendapatanBiayaBunga").text(data.result.pendapatanBiayaBunga);
            $("#pendapatanBiayaPembulatan").text(
                data.result.pendapatanBiayaPembulatan
            );
            $("#jumlahTagihan").text(data.result.jumlahTagihan);
            $("#estimasiPendapatanPinjaman").text(
                data.result.estimasiPendapatanPinjaman
            );
            $("#pendapatanPinjaman").text(data.result.pendapatanPinjaman);
            $("#pendapatanLainnya").text(data.result.pendapatanLainnya);
            $("#jumlahPendapatan").text(data.result.jumlahPendapatan);
            $("#bebanGajiKaryawan").text(data.result.bebanGajiKaryawan);
            $("#biayaListrikAir").text(data.result.biayaListrikAir);
            $("#transport").text(data.result.transport);
            $("#biayaLainnya").text(data.result.biayaLainnya);
            $("#totalBiaya").text(data.result.totalBiaya);
            $("#labaRugi").text(data.result.labaRugi);
        },
    });
}

function printData(url) {
    // Initialization
    var filter = $("#date").val();
    window.open(url + "/report/print-profit-loss?&filter=" + filter);
}
