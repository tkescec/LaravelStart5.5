@extends('layouts.admin')

@section('title')
Users
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
    <!-- Restfulizer.js - A tool for simulating put,patch and delete requests -->
    <script src="{{ asset('js/restfulizer.js') }}"></script>
@endpush

@section('content-header')
<h1>
    Users
    <small><a href="{{ route('users.create') }}" class="btn btn-primary btn-xs" role="button">Add New</a></small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Users</li>
</ol>
@stop

@section('content')
<div class="row">
    @foreach ($users as $user)
        <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header
                    @if ($user->inRole('administrator'))
                        {{ 'bg-red-active' }}
                    @elseif ($user->inRole('free'))
                        {{ 'bg-green-active' }}
                    @elseif ($user->inRole('standard'))
                        {{ 'bg-orange-active' }}
                    @elseif ($user->inRole('premium'))
                        {{ 'bg-aqua-active' }}
                    @endif
                ">
                    <h3 class="widget-user-username">{{ $user->first_name . ' ' . $user->last_name}}</h3>
                    @if ($user->roles->count() > 0)
                        <h5 class="widget-user-desc">{{ $user->roles->implode('name', ', ') }}</h5>
                    @else
                        <h5 class="widget-user-desc">No Assigned Role</h5>
                    @endif
                        <h6>{{($user->last_login != NULL)?\Carbon\Carbon::createFromTimeStamp(strtotime($user->last_login))->diffForHumans():'never'}}</h6>
                </div>
                <div class="widget-user-image">
                    <img src="https://secure.gravatar.com/avatar/{{ md5( strtolower( trim( $user->email ) ) ) }}?d=mm" alt="{{ $user->email }}" class="img-circle">
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">0</h5>
                                <span class="description-text">TEST</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 border-right">
                            <div class="description-block">
                                <h5 class="description-header">0</h5>
                                <span class="description-text">TEST</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4">
                            <div class="description-block">
                                <h5 class="description-header">0</h5>
                                <span class="description-text">TEST</span>
                            </div>
                            <!-- /.description-block -->
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-default btn-block btn-sm"><i class="fa fa-edit"></i> Edit</a>
                        </div>
                        <div class="col-sm-4">
                            <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger btn-block btn-sm action_confirm" data-method="delete" data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
{!! $users->render() !!}
@stop
