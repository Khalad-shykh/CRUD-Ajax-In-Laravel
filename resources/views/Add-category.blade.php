<!doctype html>
<html lang="en">
  <head>
    <title>Add Category</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset("DataTables/css/jquery.dataTables.min.css")}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
   <div class="container">
    <h1 class="text-center">Add Categories</h1>
    <div class="form-group col-md-6 offset-3 mt-5">
        <form id="cat_form">
            <label for="">Category Name</label>
        <input type="text"
          class="form-control" name="cat_name" id="cat_name" aria-describedby="helpId" placeholder="">
        <button type="submit" class="btn btn-primary mt-3">Add</button>
        </form>
      </div>
   </div>
   <table class="display" id="dt">
    <thead>
      <tr>
        <th>Category Id</th>
        <th>Category Name</th>
        <th>Action</th>
      </tr>
    </thead>
   </table>

   <script src="{{asset('js/jQuery.js')}}"></script>
   <script src="{{ asset("DataTables/js/jquery.dataTables.min.js")}}"></script>
   <script>
    $(document).ready(function () {
      $('#dt').DataTable({
        'sAjaxSource':'ViewCategories',
      });
        $.ajaxSetup({
            headers:{ 'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content') },
        });
        $("#cat_form").on("submit", function (e) {
            e.preventDefault();
            let cat_name = $("#cat_name").val();
            $.ajax({
                type: 'POST',
                url:'AddCategory',
                data:{cat_name:cat_name},
                success:function(response){
                    let res = $.parseJSON(response);
                    alert(res['msg']);
                    $("#cat_form").trigger("reset");
                    $('#dt').DataTable().ajax.reload();
                }
            });
        });
    $(document).on("click","#del_cat", function () {
      let cat_id = $(this).data("id");
      let descision = confirm("You Want Delete ?");
      if(descision){
        $.ajax({
        type: "GET",
        url: "DelCategories",
        data: {cat_id:cat_id},
        success: function (response) {
          $('#dt').DataTable().ajax.reload();
        }
      });
      }
    });
      });
   </script>
  </body>
</html>