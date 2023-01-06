$(document).ready(function () {
    $("#loader").hide();
    $("#loader1").hide();
    $('#dt').DataTable({
        "sAjaxSource": 'ViewProducts',
    });
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    });
    $("#save").on('click', function () {

        let p_name = $("#p_name").val();
        let p_price = $("#p_price").val();
        let p_quantity = $("#p_quantity").val();
        $.ajax({
            type: "POST",
            url: "AddProducts",
            beforeSend: function () {
                $("#loader").show();
            },
            complete: function () {
                $("#loader").hide();
            },
            data: {
                p_name: p_name,
                p_price: p_price,
                p_quantity: p_quantity
            },
            success: function (response) {
                $('#dt').DataTable().ajax.reload();
                let res = $.parseJSON(response)
                if (res['msg'] == "Success") {
                    $("#p_name").val("");
                    $("#p_price").val("");
                    $("#p_quantity").val("");
                    $("#modelId").modal("hide");
                    $("#success-alert").addClass("show");
                }

            }
        });
    });
    $(document).on("click", "#update_btn", function () {
        let id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "LoadModal",
            beforeSend: function () {
                $("#loader1").show();
            },
            complete: function () {
                $("#loader1").hide();
            },
            data: { id: id },
            success: function (response) {
                let res = $.parseJSON(response);
                $("#set").html(res['Modal']);
            }
        });
    });
    $(document).on('click', '#update', function () {
        let id = $(this).data('id');
        let u_p_name = $("#u_p_name").val();
        let u_p_price = $("#u_p_price").val();
        let u_p_quantity = $("#u_p_quantity").val();
        $.ajax({
            url: 'UpdateProducts',
            type: 'POST',
            beforeSend: function () {
                $("#loader1").show();
            },
            complete: function () {
                $("#loader1").hide();
            },
            data: {
                id: id,
                u_p_name: u_p_name,
                u_p_price: u_p_price,
                u_p_quantity: u_p_quantity
            },
            success: function (response) {
                let res = $.parseJSON(response)
                if (res['msg'] == 'Success') {
                    $('#dt').DataTable().ajax.reload();
                    let res = $.parseJSON(response)
                    $("#Update_Modal").modal("hide");
                }
                else {
                    alert(res['msg']);
                }

            }
        });
    });
    $(document).on("click", "#delete", function () {
        let id = $(this).data("id");
        let action = confirm("Are You Sure To Delete ?")
        if (action) {
            $.ajax({
                type: "POST",
                url: "DeleteProducts",
                data: { id: id },
                success: function (response) {
                    let res = $.parseJSON(response)
                    if (res['msg'] == 'success') {
                        $("#dt").DataTable().ajax.reload();
                    }
                    else {
                        alert(res['msg']);
                    }
                }
            });
        }
    });
});