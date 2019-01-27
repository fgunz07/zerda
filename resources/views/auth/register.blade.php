@extends('layouts.auth')

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/bower_components/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="register-box">

        <div class="register-logo">
            <a href="{{ url('/') }}"><b>{{ env('APP_NAME') }}</b></a>
        </div>

        <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>

        <form action="javascript:void(0);" method="post">
            <div class="form-group has-feedback" id="f_name">
                <input type="text" class="form-control" placeholder="First name" name="first_name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback" id="l_name">
                <input type="text" class="form-control" placeholder="Last name" name="last_name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback" id="m_name">
                <input type="text" class="form-control" placeholder="Middle name" name="middle_name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback" id="email">
                <input type="email" class="form-control" placeholder="Email" name="email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback" id="p_word">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback" id="c_p_word">
                <input type="password" class="form-control" placeholder="Retype password" name="confirm_password">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="form-group" id="country">
                {!! Form::select('country_id', ['1'=>'Philippines','2'=>'USA'], old('country_id', 1), ['class' => 'form-control select2']) !!}
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" id="agreement"> I agree to the <a href="#">terms</a>
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="button" class="btn btn-primary btn-block btn-flat" id="reg">Register</button>
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
    <script type="text/javascript" src="{{ asset('lib/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    <!-- include custom script for this module only -->
    <script type="text/javascript" src="{{ asset('js/pages/login.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/http.js') }}"></script>

    <script type="text/javascript">

        // select2 plugin
        $('.select2').select2()

        // call login module
        const login = loginModule

        login('input')
        .initLoginRemember({
            checkboxClass   : 'icheckbox_square-blue',
            radioClass      : 'iradio_square-blue',
            increaseArea    : '20%' /* optional */
        })

        // handle all dom manipulation
        function renderErrors(el, err) {

            err.length > 0 ? el.addClass('has-error') : ''

            err.forEach(function(errMsg) {
                el.append(`
                    <span class="help-block">${errMsg}</span>
                `)
            })

        }

        $('#reg').on('click', function(e) {
            e.preventDefault()

            const agreement = $('input#agreement')[0].checked

            if(!agreement) {

                swal('Oops!','Please check terms of agreement.','warning')

                return

            }

            // cache the DOM
            const DOM = {
                first_name  : $('input[name=first_name]').val(),
                last_name   : $('input[name=last_name]').val(),
                middle_name : $('input[name=middle_name]').val(),
                email       : $('input[name=email]').val(),
                password    : $('input[name=password]').val(),
                password_confirmation: $('input[name=confirm_password]').val(),
                country_id  : $('select[name=country_id]').val()
            }

            const options = {
                url     : `/register`,
                method  : 'POST',
                data    : DOM
            }

            http(options)
                // if request success statuc 200
                .done(function(res) {
                    
                    swal('Success', res.message, 'success')

                    setTimeout(function() {
                        window.location.href = '/login'
                    }, 1000)

                })
                // if return not status 200
                .fail(function(err) {

                    // destructure error object
                    let {
                            first_name,
                            last_name,
                            middle_name,
                            email,
                            password,
                            country_id
                        } = err.responseJSON.errors || {}
                    
                    // cache dom element that will be manipulated
                    const domHasError = {
                        f_name: $('#f_name'),
                        l_name: $('#l_name'),
                        m_name: $('#m_name'),
                        email : $('#email'),
                        p_word: $('#p_word'),
                        c_p_word: $('#c_p_word'),
                        country: $('#country')
                    }

                    if(err.status == 422) {
                        // renderer function handles error dom manipulation
                        renderErrors(domHasError.f_name,    first_name  || [])
                        renderErrors(domHasError.l_name,    last_name   || [])
                        renderErrors(domHasError.m_name,    middle_name || [])
                        renderErrors(domHasError.email,     email       || [])
                        renderErrors(domHasError.c_p_word,  password    || [])
                        renderErrors(domHasError.country,   country_id  || [])

                        return
                    }

                    swal('Error!', err.responseJSON.message, 'error')


                })

        })

    </script>
@endsection
