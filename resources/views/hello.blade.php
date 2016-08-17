<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <button id="getRequest" class="btn btn-warning">get request</button>
            </div>
            <div class="col-sm-8">
                <form action="#" id="login">
                    {{ csrf_field() }}
                    <!-- Name From Input-->
                    <div class="form-group">
                        <label for="name">Your Name:</label>
                        <input type="text" class="form-control" name="name" id="name">
                    </div>
                    <!-- Email From Input-->
                    <div class="form-group">
                        <label for="email">Your Email:</label>
                        <input type="text" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">送出</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div id="result"></div>
            <div id="data"></div>
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function () {

            $('#getRequest').click(function () {
                $.ajax({
                    type: 'get',
                    url: 'getRequest',
                    success: function (data) {
                        console.log(data);
                    }
                });
            });
            $('#login').submit(function () {
                var name = $('#name').val();
                var email = $('#email').val();

                var dataString = 'name='+ name + '&email='+ email;
                $.ajax({
                    type: 'post',
                    url: 'postLogin',
                    data: dataString,
                    success: function (data) {
                        $('#data').text(data['name']+data['email']);
                        console.log(data);
                    }
                });
//                $.post('postLogin',{name: name, email: email} ,function (data) {
//                    $('#data').html(data);
//                    console.log(data);
//                })
            });
        });
    </script>
</body>
</html>
