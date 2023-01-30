<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container col-md-6 border ">
<form id="ImgForm" method="POST" enctype="multipart/form-data" action="{{route("store")}}">
    <div class="form-group">
        <h1 class="text-center" >Image Upload Using Ajax</h1>
        <label for=""></label>
        <input type="file" class="form-control-file" name="img" id="img" placeholder="" aria-describedby="fileHelpId">
        <span class="text-danger" id="image-input-error"></span><br>
        <button type="submit" class="btn-sm btn-success">Upload</button>
        <div class="mt-3">
            <img id="preview-image" width="150px">
        </div>
      </div>
</form>
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="rows">
    </tbody>
</table>
    </div>
    <script src="{{asset('js/jQuery.js')}}"></script>
    <script>  
    $(document).ready(function () {
        loadData();
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
            $('#img').change(function(){    
        let reader = new FileReader();
        reader.onload = (e) => { 
            $('#preview-image').attr('src', e.target.result); 
        }   
        reader.readAsDataURL(this.files[0]); 
    });  


$("#ImgForm").on("submit", function (e) {
    e.preventDefault();
    formData = new FormData(this);
    $.ajax({
        type: "POST",
        url: "ImageUpload",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
            let res = $.parseJSON(response)
            if(res['status_code'] == 200){
                alert(res['msg']);
                $("#ImgForm").trigger("reset");
                loadData();
            }
            
        },
        error: function(response){
            $('#image-input-error').text(response.responseJSON.message);
            // $.each(response.responseJSON, function (key, val) { 
            //      console.log(val.img)
            // });
                }
    });
    
});
function loadData(){
        $.ajax({
            type: "GET",
            url: "ImageView",
            success: function (response) {
                let res = $.parseJSON(response);
                // alert();
                $(".rows").html(res['data']);
            }
        });
    }
    });
    </script>  
  </body>
</html>