$(document).ready(function () { 
    // Action On Modal Open For Adding
    $("#AddModel").on("click", function () {
        $("#MyModal").modal().show();
        $("#MyForm").trigger("reset");
        $("#update").hide()
        $("#save").show()
        // Action On Modal Open For Adding End
    });
    //loading Data Tables
    $('#dt').DataTable({
        "sAjaxSource": 'ViewProducts',
    });
    // setting Up ajax
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    });
    // Adding Data Using Ajax
    $("#save").on('click', function () {

        let p_name = $("#p_name").val();
        let p_price = $("#p_price").val();
        let p_quantity = $("#p_quantity").val();
        let c_id = $("#category").find(":selected").val()
        $.ajax({
            type: "POST",
            url: "AddProducts",
            data: {
                p_name: p_name,
                p_price: p_price,
                p_quantity: p_quantity,
                c_id: c_id
            },
            success: function (response) {
                $('#dt').DataTable().ajax.reload();
                let res = $.parseJSON(response)
                if (res['msg'] == "Success") {
                    $("#p_name").val("");
                    $("#p_price").val("");
                    $("#p_quantity").val("");
                    $("#MyModal").modal("hide");
                    swal("Good job!", "Item Added Successfully", "success");
                }

            }
        });
    });
    // Adding Data Using Ajax End
    // Loading Data Using Ajax For Update 
    $(document).on("click", "#update_btn", function () {
        let id = $(this).data("id");
        $("#MyModal").modal().show();
        $.ajax({
            type: "POST",
            url: "GetValues",
            data: { id: id },
            success: function (response) {
                let res = $.parseJSON(response);
                $(".modal-title").html("Update Products");
                $("#save").hide();
                $("#update").show()
                $("#p_name").val(res['p_name']);
                $("#p_price").val(res['p_price']);
                $("#p_quantity").val(res['p_quantity']);
                $("#p_id").val(res['p_id']);
                $("#category").val(res['cat_id']);
            }
        });
    });
    // Loading Data Using Ajax For Update end
    // Updating Data Using Ajax 
    $('#update').on('click', function () {
        let id = $("#p_id").val();
        let u_p_name = $("#p_name").val();
        let u_p_price = $("#p_price").val();
        let u_p_quantity = $("#p_quantity").val();
        let c_id = $("#category").find(":selected").val()
        $.ajax({
            url: 'UpdateProducts',
            type: 'POST',
            data: {
                id: id,
                u_p_name: u_p_name,
                u_p_price: u_p_price,
                u_p_quantity: u_p_quantity,
                c_id:c_id
            },
            success: function (response) {
                let res = $.parseJSON(response)
                if (res['msg'] == 'Success') {
                    $('#dt').DataTable().ajax.reload();
                    let res = $.parseJSON(response)
                    $("#MyModal").modal("hide");;
                    swal("Good job!", "Item Updated Successfully", "success");
                }
                else {
                    alert(res['msg']);
                }

            }
        });
    });
    // Updating Data Using Ajax End
    // Deleting Data Using Ajax 
    $(document).on("click", "#delete", function () {
        let id = $(this).data("id");
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
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
    // Deleting Data Using Ajax End
});