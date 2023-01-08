<!doctype html>
<html lang="en">
  <head>
    <title>Ajax CRUD</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }} ">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
    <!-- ###################### Add Modal Button ################## -->
    <button type="button" class="btn-sm btn-success btn-lg" data-toggle="modal" id="AddModel">
      Add Products
    </button>
    {{-- ###################### Success Alert ################## --}}
<div class="alert alert-success alert-dismissible fade " role="alert" id="success-alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <strong>Data Succesfully Added</strong>
</div>
    {{-- ###################### Success Alert End ################## --}}
{{-- ################################ Modal ################################## --}}
    <div class="modal fade" id="MyModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Products</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <input type="hidden" value="" id="p_id">
                      <input type="text" class="form-control" name="" id="p_name" aria-describedby="helpId" placeholder="Enter Product Name">
                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="" id="p_price" aria-describedby="helpId" placeholder="Enter Product Price">
                      </div>
                      <div class="form-group">
                        <input type="number" class="form-control" name="" id="p_quantity" aria-describedby="helpId" placeholder="Enter Product Quantity">
                      </div>
                      <div class="form-group">
                    <div class="form-group">
                      <label for="">Select Category : </label>
                      <select class="form-control" id="category">
                        @foreach ($categories as $c)
                        <option value="{{$c->cat_id}}">{{$c->cat_name}}</option>
                        @endforeach
                        
                      </select>
                    </div>
                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save" >Save</button>
                    <button type="button" class="btn btn-primary" id="update" >Update</button>
                </div>
            </div>
        </div>
    </div>
    {{-- ################################ Modal End################################## --}}
    <table id="dt" class="display">
        <thead>
            <tr>
<th>name</th>
<th>Price</th>
<th>Quantity</th>
<th>Action</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="{{asset('js/jQuery.js')}}"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{asset('js/script.js')}}"></script>  
</body>
</html>