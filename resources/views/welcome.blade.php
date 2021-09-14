<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<title>Laravel Ajax Post Request Example</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
<div class="container">
    <h1>Laravel Ajax Post Request Example</h1>
      {{-- <span class="success" style="color:green; margin-top:10px; margin-bottom: 10px;"></span> --}}
    <form id="ajaxform">

        <div class="form-group">
            <label>First Name:</label>
            <input type="text" name="first_name" class="form-control" placeholder="Enter First Name" required="">
        </div>

        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name" required="">
        </div>

        <div class="form-group">
            <strong>Email:</strong>
            <input type="email" name="email" class="form-control" placeholder="Enter Email" required="">
        </div>
        <div class="form-group">
            <strong>Username:</strong>
            <input type="text" name="username" class="form-control" placeholder="Enter Your Username" required="">
        </div>
        <div class="form-group">
            <button class="btn btn-success save-data">Save</button>
        </div>
    </form>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">first_name</th>
          <th scope="col">last_name</th>
          <th scope="col">email</th>
          <th scope="col">username</th>
        </tr>
      </thead>
      <tbody>
        @forelse($users as $user)
            <tr>
                <td>{{ $user['first_name'] }}</td>
                <td>{{ $user['last_name'] }}</td>
                <td>{{ $user['email'] }}</td>
                <td>{{ $user['username'] }}</td>
            </tr>
        @empty
            <p>No users Stored</p>
        @endforelse
      </tbody>
    </table>
</div>
<script>

    $(".save-data").click(function(event){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        event.preventDefault();
        let first_name = $("input[name=first_name]").val();
        let last_name = $("input[name=last_name]").val();
        let email = $("input[name=email]").val();
        let username = $("input[name=username]").val();

        $.ajax({
            url: "/",
            type:"POST",
            data:{
                first_name:first_name,
                last_name:last_name,
                email:email,
                username:username,
            },
            success:function(response){
                console.log(response);
                if(response) {
                    $('.success').text(response.success);
                    $("#ajaxform")[0].reset();
                    $users = response.users;
                    $('.table').html('<thead><tr><th scope="col">first_name</th><th scope="col">last_name</th><th scope="col">email</th><th scope="col">username</th></tr></thead>');
                    $users.forEach((user) => {
                        $('.table tr:last').after(
                            '<tr><td>' + user.first_name + '</td><td>' + user.last_name + '</td><td>' + user.email + '</td><td>' + user.username + '</td></tr>'
                            );
                    });
                }
            },
            error: function() {
                console.log('error');
            }
        });
       // $.ajax({
       //  type: 'GET',
       //  url: '/show',
       //  success:function (users) {
       //      users.forEach((user) => {
       //          $('.table tr:last')->after(
       //              "<tr>
       //              <td> " + user.first_name + "</td>
       //              <td> " user.last_name + "</td>
       //              <td> " + user.email + "</td>
       //              <td> " user.username + "</td>
       //              </tr>"
       //          );
       //      });
       //
       //
       //  },
       //  error: function() {
       //       console.log('error');
       //  }
       // });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>
