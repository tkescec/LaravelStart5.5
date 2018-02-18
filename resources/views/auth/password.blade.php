@extends('layouts.auth')

@section('title')
Create A New Password
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
@endpush

@push('scripts')
    <!-- jQuery 3 -->
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
@endpush

@section('content')
<div class="register-box-body">
    <p class="login-box-msg">Create A New Password</p>

    <form accept-charset="UTF-8" role="form" method="post" action="{{ route('auth.password.reset.attempt', $code) }}">
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
        {{ csrf_field() }}
        <button type="submit" class="btn btn-primary btn-block btn-flat">Save</button>
    </form>
</div>
@stop
