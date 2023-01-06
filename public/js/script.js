$(document).ready(function () {
    $('#dt').DataTable({
        "sAjaxSource":'ViewProducts',
    });
    $.ajaxSetup({
            headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
        });
    $("#save").on('click', function () {
        
        let p_name = $("#p_name").val();
        let p_price = $("#p_price").val();
        let p_quantity = $("#p_quantity").val();
        $.ajax({
            type: "POST",
            url: "AddProducts",
            data: {
                p_name:p_name,
                p_price:p_price,
                p_quantity:p_quantity
            },
            success: function (response) {
                $('#dt').DataTable().ajax.reload();
                let res = $.parseJSON(response)
                $("#modelId").modal("hide");
                    $("#success-alert").addClass("show");
                
            }
        });
    });
$(document).on("click","#update_btn", function () {
    let id = $(this).data("id");
    $.ajax({
        type: "POST",
        url: "LoadModal",
        data: {id:id},
        success: function (response) {
            let res = $.parseJSON(response);
            $("#set").html(res['Modal']);
        }
    });
});
$(document).on('click','#save', function(){
    let id = $(this).data('id');
    let u_p_name = $("#u_p_name").val();
    let u_p_price = $("#u_p_price").val();
    let u_p_quantity = $("#u_p_quantity").val();
    $.ajax({
        url:'UpdateProducts',
        type:'POST',
        data:{
            id:id,
            u_p_name:u_p_name,
            u_p_price:u_p_price,
            u_p_quantity:u_p_quantity
        },
        success:function(response){
            $('#dt').DataTable().ajax.reload();
                let res = $.parseJSON(response)
                $("#Update_Modal").modal("hide");
        }
    });
});
$(document).on("click","#delete", function () {
let id = $(this).data("id");
let action = confirm("Are You Sure To Delete ?")
if(action)
{
    $.ajax({
    type: "POST",
    url: "DeleteProducts",
    data: {id:id},
    success: function (response) {
        let res = $.parseJSON(response)
        if(res['msg'] == 'success')
        {
            $("#dt").DataTable().ajax.reload();
        }
        else{
            alert(res['msg']);
        }
    }
});
}
});
});