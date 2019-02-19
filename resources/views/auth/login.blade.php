<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="{{ asset('app-asset/images/icons/favicon.png') }}"/>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" href="{{ asset('app-asset/css/login.css') }}">
        <title>Login</title>
    </head>
    <body>

        <div class="wrapper fadeInDown">
          <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first my-5">
              <img src="{{ asset('app-asset/images/icons/logo.png') }}" id="icon" alt="User Icon" />
            </div>

            @if(!empty($errors->first('email')))
            <p class="text-danger">Email or password not found!</p>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
              <input type="text" id="login" class="fadeIn second" name="email" autocomplete="off" placeholder="email" required>
              <input type="password" id="password" class="fadeIn third" name="password" autocomplete="off" placeholder="password" required>
              <button type="submit" class="fadeIn fourth">Log In</button>
              <br>
              <a href="{{ url('/register') }}" class="my-4">Register</a>
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
              <a class="underlineHover" href="{{ url('/') }}">Go to the Site</a>
            </div>

          </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    </body>
</html>
