@extends('layouts.auth')

@section('content')
    <div class="login-box">
      <div class="login-logo">
        <a href="{{ url('/') }}"><b>{{ env('APP_NAME') }}</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <div class="form-group" id="error-view"></div>

        <form action="javascript:void(0);" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label>
                  <input type="checkbox"> Remember Me
              </label>
          </div>
      </div>
      <!-- /.col -->
      <div class="col-xs-4">
          <button type="button" class="btn btn-primary btn-block btn-flat" id="login">Sign In</button>
      </div>
      <!-- /.col -->
    </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="{{ route('facebook.auth') }}" class="btn btn-block btn-social btn-facebook btn-flat"><i class="ion-social-facebook"></i> Sign in using
      Facebook</a>
    </div>
    <!-- /.social-auth-links -->

    <a href="{{ route('password.request') }}">I forgot my password</a><br>
    <a href="{{ route('register') }}" class="text-center">Register a new membership</a>

    </div>
    <!-- /.login-box-body -->
    </div>
@endsection

@section('custom_script')
    <!-- include lib script for this module only -->
    <script type="text/javascript" src="{{ asset('lib/plugins/iCheck/icheck.min.js') }}"></script>

    <!-- include custom script for this module only -->
    <script type="text/javascript" src="{{ asset('js/pages/login.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/http.js') }}"></script>

    <!-- custom script -->
    <script type="text/javascript">

        // call login module
        const login = loginModule

        login('input')
        .initLoginRemember({
            checkboxClass   : 'icheckbox_square-blue',
            radioClass      : 'iradio_square-blue',
            increaseArea    : '20%' /* optional */
        })

        function renderError(el , err) {

          el.empty()
          el.addClass('has-error')
          err.forEach(function(errMsg) {

            el.append(`
              <span class="help-block">${errMsg}</span>
            `)

          })

        }

        $('button#login').on('click', function(e) {
          e.preventDefault()

          const DOM = {
              email   : $('input[name=email]').val(),
              password: $('input[name=password]').val() 
          }

          const options = {
            url   : '/login',
            method: 'POST',
            data: DOM
          }

          console.log(DOM)

          http(options)
            .done(function(res) {

              console.log(res)

              swal('Success', 'Redirecting ...', 'success');

              setTimeout(function() {

                window.location.href = '/home'

              }, 1000)
            })
            .fail(function(err) {

              console.log(err)

              let { email } = err.responseJSON.errors || {}

              if(err.status == 422) {
                renderError($('div#error-view'), email)

                return
              }

              swal('Error', err.responseText, 'error')

            })

        })

    </script>
@endsection