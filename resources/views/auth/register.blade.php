@extends('layouts.auth')

@section('title')
Register Page
@stop

@push('styles')
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/dist/css/AdminLTE.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/iCheck/square/blue.css') }}">
@endpush

@push('scripts')
    <!-- jQuery 3 -->
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('bower_components/admin-lte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
@endpush

@section('content')
<div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form accept-charset="UTF-8" role="form" method="post" action="{{ route('auth.register.attempt') }}">
        <div class="form-group has-feedback {{ ($errors->has('first_name')) ? 'has-error' : '' }}">
            <input class="form-control" placeholder="First name" name="first_name" type="text" value="{{ old('first_name') }}">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            {!! ($errors->has('first_name') ? $errors->first('first_name', '<p class="text-danger">:message</p>') : '') !!}
        </div>
        <div class="form-group has-feedback {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
            <input class="form-control" placeholder="Last name" name="last_name" type="text" value="{{ old('last_name') }}">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            {!! ($errors->has('last_name') ? $errors->first('last_name', '<p class="text-danger">:message</p>') : '') !!}
        </div>
        <div class="form-group has-feedback {{ ($errors->has('email')) ? 'has-error' : '' }}">
            <input class="form-control" placeholder="E-mail" name="email" type="text" value="{{ old('email') }}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            {!! ($errors->has('email') ? $errors->first('email', '<p class="text-danger">:message</p>') : '') !!}
        </div>
        <div class="form-group has-feedback {{ ($errors->has('password')) ? 'has-error' : '' }}">
            <input class="form-control" placeholder="Password" name="password" type="password" value="">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            {!! ($errors->has('password') ? $errors->first('password', '<p class="text-danger">:message</p>') : '') !!}
        </div>
        <div class="form-group has-feedback {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
            <input class="form-control" placeholder="Retype password" name="password_confirmation" type="password" value="">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            {!! ($errors->has('password_confirmation') ? $errors->first('password_confirmation', '<p class="text-danger">:message</p>') : '') !!}
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input name="terms" type="checkbox" value="true" {{ (old('terms') == 'true') ? 'checked' : ''}}> I agree to the <a href="#">terms</a>
                        {!! ($errors->has('terms') ? $errors->first('terms', '<p class="text-danger">:message</p>') : '') !!}
                    </label>
                </div>
            </div>
            <div class="col-xs-4">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
            </div>
        </div>
    </form>
    <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
        <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
    </div>
    <a href="{{ route('auth.login.form') }}" class="text-center">I already have a membership</a>
</div>
@stop
