@extends('layouts.admin')

@section('title')
Pages - {{ Request::get('status') }}
@stop

@push('styles')
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/dist/css/skins/skin-blue.min.css') }}">
    <style>
        .action_confirm{
            cursor:pointer;
        }
    </style>
@endpush

@push('scripts')
    <!-- jQuery 3 -->
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
    <!-- Restfulizer.js - A tool for simulating put,patch and delete requests -->
    <script src="{{ asset('js/restfulizer.js') }}"></script>
    <script>
        $(function () {
            $('#pages').DataTable();
            $('.row-with-options').mouseenter(function(){
                $('.post-type-options', this).show();
            });
            $('.row-with-options').mouseleave(function(){
                $('.post-type-options', this).hide();
            });
        });
    </script>
@endpush

@section('content-header')
<h1>
    Pages
    <small><a href="{{ route('pages.create') }}" class="btn btn-primary btn-xs" role="button">Add New</a></small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Pages</li>
</ol>
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li><a href="{{ route('pages.index', 'status=trashed') }}">Trash <span class="label label-danger">{{ $trash_count }}</span></a></li>
                        <li><a href="{{ route('pages.index', 'status=drafted') }}">Draft <span class="label label-warning">{{ $draft_count }}</span></a></li>
                        <li><a href="{{ route('pages.index', 'status=published') }}">Publish <span class="label label-success">{{ $publish_count }}</span></a></li>
                        <li class="pull-left header">{{ str_replace('ed','',ucfirst(Request::get('status'))) }}</li>
                    </ul>
                </div>
            </div>
            <div class="box-body">
                <table id="pages" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Title</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $page)
                        <tr class="row-with-options" style="height:60px;">
                            <td></td>
                            <td class="text-primary">
                                <b>{{ $page->title }}</b>
                                @if(Request::get('status') === 'published' || Request::get('status') === 'drafted')
                                <div class="post-type-options" style="display:none;">
                                    <a href="{{ route('pages.edit', $page->id) }}">Edit</a>&nbsp;
                                    <a href="{{ route('pages.destroy', $page->id) }}" class="text-danger action_confirm" data-method="delete" data-token="{{ csrf_token() }}" data-status="{{ Request::get('status') }}">Delete</a>&nbsp;
                                    <a href="{{ route('pages.show', $page->id) }}" target="_blank">Preview</a>
                                </div>
                                @endif
                                @if(Request::get('status') === 'trashed')
                                <div class="post-type-options" style="display:none;">
                                    <a href="{{ route('pages.restore', $page->id) }}">Restore</a>&nbsp;
                                    <a href="{{ route('pages.destroy', $page->id) }}" class="text-danger action_confirm" data-method="delete" data-token="{{ csrf_token() }}" data-status="{{ Request::get('status') }}">Permanently delete</a>&nbsp;
                                </div>
                                @endif
                            </td>
                            <td>
                                Created
                                <br>
                                <abbr style="text-decoration:none;" title="{{ $page->created_at }}">{{ date('d/m/Y', strtotime($page->created_at)) }}</abbr>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
