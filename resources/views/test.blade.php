<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="form-group">
      <label for=""></label>
      <select class="form-control" name="" id="test">
        <option value="2">Electronics</option>
      </select>
    </div>
    <script src="{{asset('js/jQuery.js')}}"></script>
    <script>
        $(document).ready(function () {
            let c = $("#test").find(":selected").val()
            alert(c);
        });
    </script>
</body>
</html>