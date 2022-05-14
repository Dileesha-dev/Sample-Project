<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{config('app.name')}}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <style>
            body {
                font-family: 'Nunito', sans-serif;
                height: 100vh;
            }
            a{
                text-decoration: none;
                font-weight: 600;
                letter-spacing: 0.1rem;
                cursor: pointer;
                color: #636b6f;
            }
            .wrapper{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .brandName{
                font-size: 84px;
                font-weight: 200;
                color: #636b6f;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
              <div class="ms-auto py-3">
                <a class="navbar-text m-3" href="{{ route('login') }}">
                    LOGIN
                  </a>
                  <a class="navbar-text m-3" href="{{ route('register') }}">
                    REGISTER
                  </a>
              </div>
            </div>
        </nav>
        <div class="wrapper container h-75">
            <h1 class="brandName m-5">{{config('app.name')}}</h1>
            <a href="{{ route('login') }}">
                LOGIN
            </a>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
</html>
