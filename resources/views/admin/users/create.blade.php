@extends('layouts.admin')

@section('title')
Create New User
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
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/dist/css/skins/skin-blue.min.css') }}">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/plugins/iCheck/all.css') }}">
@endpush

@push('scripts')
    <!-- jQuery 3 -->
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('bower_components/admin-lte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
    $(function () {
        //Flat blue color scheme for iCheck
        $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass   : 'iradio_flat-blue'
        });
    });
    </script>
@endpush

@section('content-header')
<h1>
    Add New User
    <small><a href="{{ url()->previous() }}" class="btn btn-primary btn-xs" role="button">Back</a></small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('users.index') }}">Users</a></li>
    <li class="active">Add</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Add New User</h3>
            </div>
            <form accept-charset="UTF-8" role="form" method="post" action="{{ route('users.store') }}">
                <div class="box-body">
                    <div class="form-group {{ ($errors->has('first_name')) ? 'has-error' : '' }}">
                        <label for="first-name">First Name</label>
                        <input class="form-control" id="first-name" placeholder="Enter user first name" name="first_name" type="text" value="{{ old('first_name') }}" />
                        {!! ($errors->has('first_name') ? $errors->first('first_name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
                        <label for="last-name">Last Name</label>
                        <input class="form-control" id="last-name" placeholder="Enter user last name" name="last_name" type="text" value="{{ old('last_name') }}" />
                        {!! ($errors->has('last_name') ? $errors->first('last_name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                        <label for="email">E-mail</label>
                        <input class="form-control" id="email" placeholder="Enter user e-mail address" name="email" type="text" value="{{ old('email') }}">
                        {!! ($errors->has('email') ? $errors->first('email', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group">
                        <label>Roles</label>
                        <br />
                        @foreach ($roles as $role)
                        <div class="form-group">
                            <label>
                                <input type="checkbox" class="flat-blue" name="roles[{{ $role->slug }}]" value="{{ $role->id }}"> {{ '&nbsp; ' . $role->name }}
                            </label>&nbsp;&nbsp;
                        </div>
                        @endforeach
                        <p class="text-muted"><em>Add one or muliple roles to user.</em></p>
                    </div>
                    <hr />
                    <div class="form-group  {{ ($errors->has('password')) ? 'has-error' : '' }}">
                        <label for="password">Password</label>
                        <input class="form-control" id="password" placeholder="Enter password" name="password" type="password" value="">
                        {!! ($errors->has('password') ? $errors->first('password', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
                        <label for="password-again">Confirm Password</label>
                        <input class="form-control" id="password-again" placeholder="Re-enter password" name="password_confirmation" type="password" />
                        {!! ($errors->has('password_confirmation') ? $errors->first('password_confirmation', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" class="flat-blue" name="activate" value="true" {{ old('activate') == 'true' ? 'checked' : ''}}> &nbsp; Activate
                        </label>&nbsp;&nbsp;
                        <p class="text-muted"><em>Enable to activate user account immediately.</em></p>
                    </div>
                    {{ csrf_field() }}
                    <input class="btn btn-lg btn-primary" type="submit" value="Add New User">
                </div>
            </form>
        </div>
    </div>
</div>
@stop
