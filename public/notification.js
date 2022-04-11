function konfirmasi(id) {
    $.ajax({
        url: "/notificationUpdateStatus",
        data: { id: id },
        type: "get",
        success: function (data) {
            if (data.status == "Success") {
                swal(data.message, {
                    icon: "success",
                });
                $(".removeThisData" + id).remove();
                location.reload();
            } else {
                swal(data.message, {
                    icon: "danger",
                });
            }
        },
        error: function (data) {
            // edit(id);
        },
    });
}
