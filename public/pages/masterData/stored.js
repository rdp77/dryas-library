$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function save(redirect) {
    var form = $("#stored");
    $("#data").removeClass("card-progress-dismiss");
    $("#data").addClass("card-progress");
    formdata = new FormData(form[0]);
    // $("#data").addClass("card-progress");
    $.ajax({
        url: url,
        data: formdata ? formdata : form.serialize(),
        type: "POST",
        processData: false,
        contentType: false,
        success: function (data) {
            // $("#data").removeClass("card-progress-dismiss");
            if (data.status == "success") { 
                $("#data").removeClass("card-progress");
                swal(data.data, {
                    icon: "success",
                }).then(function () {
                    if (redirect == 1) {
                        window.location = proposalLoan;
                    } else {
                        window.location = index;
                    }
                });
            } else if (data.status == "error") {
                $("#data").removeClass("card-progress");
                for (var number in data.data) {
                    iziToast.error({
                        title: "Error",
                        position: "center",
                        message: data.data[number],
                    });
                }
            }
        },
    });
}

function update() {
    var form = $("#stored");
    $("#data").removeClass("card-progress-dismiss");
    $("#data").addClass("card-progress");
    formdata = new FormData(form[0]);
    formdata.append("_method", "PATCH");
    $.ajax({
        url: url,
        data: formdata ? formdata : form.serialize(),
        type: "POST",
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.status == "success") {
                $("#data").removeClass("card-progress");
                swal(data.data, {
                    icon: "success",
                }).then(function () {
                    window.location = index;
                });
            } else if (data.status == "error") {
                $("#data").removeClass("card-progress");
                for (var number in data.data) {
                    iziToast.error({
                        title: "Error",
                        position: "center",
                        message: data.data[number],
                    });
                }
            }
        },
    });
}
