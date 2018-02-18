@extends('layouts.admin')

@section('title')
Edit Role
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
    Edit Role
    <small><a href="{{ url()->previous() }}" class="btn btn-primary btn-xs" role="button">Back</a></small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('roles.index') }}">Roles</a></li>
    <li class="active">Edit</li>
</ol>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Role</h3>
            </div>
            <form accept-charset="UTF-8" role="form" method="post" action="{{ route('roles.update', $role->id) }}">
                <div class="box-body">
                    <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
                        <label for="role-name">Name</label>
                        <input class="form-control" id="role-name" placeholder="Enter role name" name="name" type="text" value="{{ $role->name }}" />
                        {!! ($errors->has('name') ? $errors->first('name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group {{ ($errors->has('slug')) ? 'has-error' : '' }}">
                        <label for="role-name">Slug</label>
                        <input class="form-control" id="role-slug" placeholder="Generated automatically from the role name." name="slug" type="text" value="{{ $role->slug }}" pattern="[a-z0-9-]+" disabled />
                        {!! ($errors->has('slug') ? $errors->first('slug', '<p class="text-danger">:message</p>') : '') !!}
                        <p class="text-muted"><em>The “slug” is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.</em></p>
                    </div>
                    <hr />
                    <div class="col-md-8">
                        <!-- Custom Tabs (Pulled to the right) -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs pull-right">
                                <li><a href="#tab_3" data-toggle="tab">Pages</a></li>
                                <li><a href="#tab_2" data-toggle="tab">Roles</a></li>
                                <li class="active"><a href="#tab_1" data-toggle="tab">Users</a></li>
                                <li class="pull-left header"><i class="fa fa-user-plus"></i> Permissions</li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="checkbox">
                                        <label>
                                            <input class="flat-blue" type="checkbox" name="permissions[users.create]" value="1" {{ $role->hasAccess('users.create') ? 'checked' : '' }}>
                                            &nbsp; create
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input class="flat-blue" type="checkbox" name="permissions[users.update]" value="1" {{ $role->hasAccess('users.update') ? 'checked' : '' }}>
                                            &nbsp; update
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input class="flat-blue" type="checkbox" name="permissions[users.view]" value="1" {{ $role->hasAccess('users.view') ? 'checked' : '' }}>
                                            &nbsp; view
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input class="flat-blue" type="checkbox" name="permissions[users.destroy]" value="1" {{ $role->hasAccess('users.destroy') ? 'checked' : '' }}>
                                            &nbsp; delete
                                        </label>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <div class="checkbox">
                                        <label>
                                            <input class="flat-blue" type="checkbox" name="permissions[roles.create]" value="1" {{ $role->hasAccess('roles.create') ? 'checked' : '' }}>
                                            &nbsp; create
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input class="flat-blue" type="checkbox" name="permissions[roles.update]" value="1" {{ $role->hasAccess('roles.update') ? 'checked' : '' }}>
                                            &nbsp; update
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input class="flat-blue" type="checkbox" name="permissions[roles.view]" value="1" {{ $role->hasAccess('roles.view') ? 'checked' : '' }}>
                                            &nbsp; view
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input class="flat-blue" type="checkbox" name="permissions[roles.destroy]" value="1" {{ $role->hasAccess('roles.destroy') ? 'checked' : '' }}>
                                            &nbsp; delete
                                        </label>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_3">
                                    <div class="checkbox">
                                        <label>
                                            <input class="flat-blue" type="checkbox" name="permissions[pages.create]" value="1" {{ $role->hasAccess('pages.create') ? 'checked' : '' }}>
                                            &nbsp; create
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input class="flat-blue" type="checkbox" name="permissions[pages.update]" value="1" {{ $role->hasAccess('pages.update') ? 'checked' : '' }}>
                                            &nbsp; update
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input class="flat-blue" type="checkbox" name="permissions[pages.view]" value="1" {{ $role->hasAccess('pages.view') ? 'checked' : '' }}>
                                            &nbsp; view
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input class="flat-blue" type="checkbox" name="permissions[pages.destroy]" value="1" {{ $role->hasAccess('pages.destroy') ? 'checked' : '' }}>
                                            &nbsp; delete
                                        </label>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- nav-tabs-custom -->
                    </div>
                    <div class="col-md-12">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input name="_method" value="PUT" type="hidden">
                        <input class="btn btn-lg btn-primary" type="submit" value="Update Role Information">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
