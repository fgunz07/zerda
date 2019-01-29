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
                          <form class="form" method="" action="">
                            <div class="card-header card-header-primary text-center">
                              <h4 class="card-title">Login</h4>
                              <div class="social-line">
                                <a href="#pablo" class="btn btn-just-icon btn-link">
                                  <i class="fa fa-facebook-square">facebook</i>
                                </a>
                                <a href="#pablo" class="btn btn-just-icon btn-link">
                                  <i class="fa fa-twitter">twitter</i>
                                </a>
                                <a href="#pablo" class="btn btn-just-icon btn-link">
                                  <i class="fa fa-google-plus">google</i>
                                </a>
                              </div>
                            </div>
                            <p class="description text-center">Or Be Classical</p>
                            <div class="card-body">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="material-icons">face</i>
                                  </span>
                                </div>
                                <input type="text" class="form-control" placeholder="First Name...">
                              </div>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="material-icons">mail</i>
                                  </span>
                                </div>
                                <input type="email" class="form-control" placeholder="Email...">
                              </div>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">
                                    <i class="material-icons">lock_outline</i>
                                  </span>
                                </div>
                                <input type="password" class="form-control" placeholder="Password...">
                              </div>
                            </div>
                            <div class="footer text-center">
                              <a href="#pablo" class="btn btn-primary btn-link btn-wd btn-lg">Get Started</a>
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
