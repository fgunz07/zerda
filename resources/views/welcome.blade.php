<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/material-kit.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}">
      
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <!-- <div class="title m-b-md">
                    {{ env('APP_NAME') }}
                </div>

                <div class="links">
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                </div> -->
                <div class="section section-signup page-header" style="background-image: url('/images/city.jpg');">
                  <div class="container">
                    <div class="row">
                      <div class="col-lg-4 col-md-6 ml-auto mr-auto">
                        <div class="card card-login">
                          <form class="form" method="POST" action="">
                            <div class="card-header card-header-primary text-center">
                              <div>
                                  <img src="{{url('/images/zerda2.png')}}" alt="Image"/>
                              </div>
                            </div>
                            <div class="card-body">
                              <div class=" text-center">
                                <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                                <a href="{{ route('register') }}" class="btn btn-primary btn-link btn-wd btn-lg">Register</a>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </body>
</html>
