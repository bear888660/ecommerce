
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Signin Template · Bootstrap</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="{{asset('dist/css/signin.css')}}" rel="stylesheet">
  </head>
  <body class="text-center">
    <form class="form-signin" method="POST" action="{{route('admin.login')}}">
        <h1 class="h3 mb-3 font-weight-normal">後台登入</h1>
        @csrf
        <label for="inputAccount" class="sr-only">帳號：</label>
        <input type="text" name="username" id="inputAccount" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Account address" required autofocus>

        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control is-invalid{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required>


            @if($errors->any())

                <h5>{{$errors->first()}}</h5>
            @endif


        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>
    <div>

    </div>

</body>
</html>

