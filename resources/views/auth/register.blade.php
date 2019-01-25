@extends('layouts.app')

@section('content')
    <div class="register-box">
        <div class="register-logo">
        <a href="{{ url('/') }}"><b>{{ env('APP_NAME') }}</b></a>
        </div>

        <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>

        <form action="javascript:void(0);" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="First name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Last name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Middle name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Retype password">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                {!! Form::select('country_id', ['1'=>'Philippines','2'=>'USA'], old('country_id', 1), ['class' => 'form-control select2']) !!}
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> I agree to the <a href="#">terms</a>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <div class="social-auth-links text-center">
            <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="ion-social-facebook"></i> Sign up using
            Facebook</a>
        </div>

        <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->
@endsection

@section('custom_script')

    <!-- Using the existing module -->

    <!-- include lib script for this module only -->
    <script type="text/javascript" src="{{ asset('lib/plugins/iCheck/icheck.min.js') }}"></script>

    <!-- include custom script for this module only -->
    <script type="text/javascript" src="{{ asset('js/pages/login.js') }}"></script>

    <script type="text/javascript">
        // call login module
        const login = loginModule

        login('input')
        .initLoginRemember({
            checkboxClass   : 'icheckbox_square-blue',
            radioClass      : 'iradio_square-blue',
            increaseArea    : '20%' /* optional */
        })
    </script>
@endsection
