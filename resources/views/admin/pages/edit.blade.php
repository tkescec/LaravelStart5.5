@extends('layouts.admin')

@section('title')
Edit Page
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
    <!-- CK Editor -->
    <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ asset('bower_components/admin-lte/plugins/iCheck/icheck.min.js') }}"></script>
    <!-- Restfulizer.js - A tool for simulating put,patch and delete requests -->
    <script src="{{ asset('js/restfulizer.js') }}"></script>
    <script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        var editor = CKEDITOR.replace('page-desc', {
            filebrowserImageBrowseUrl: '/filemanager?type=Images',
            filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/filemanager?type=Files',
            filebrowserUploadUrl: '/filemanager/upload?type=Files&_token='
        });
        $('[data-toggle="tooltip"]').tooltip();
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
    Edit Page
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ route('pages.index') }}">Pages</a></li>
    <li class="active">Edit</li>
</ol>
@stop

@section('content')
<div class="row">
    <form accept-charset="UTF-8" role="form" method="post" action="{{ route('pages.update', $page->id) }}" enctype="multipart/form-data">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Page Details</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group {{ ($errors->has('page_title')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Enter page title" name="page_title" type="text" value="{{ $page->title }}" autofocus />
                        {!! ($errors->has('page_title') ? $errors->first('page_title', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group">
                        <label for="page-desc">Page Content</label>
                        <textarea id="page-desc" name="page_desc" rows="10" cols="80">{{ $page->content }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        <div class="sidebar">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Publish</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="radio">
                        <label>
                            <input class="flat-blue" type="radio" name="status" value="0" {{ ($page->draft === 0) ? 'checked' : '' }}>
                            &nbsp; Publish
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input class="flat-blue" type="radio" name="status" value="1" {{ ($page->draft === 1) ? 'checked' : '' }}>
                            &nbsp; Draft
                        </label>
                    </div>
                </div>
                <div class="box-footer with-border">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <input class="btn btn-primary" type="submit" value="Update Page">
                    <a href="{{ route('pages.index', 'status=published') }}" class="btn btn-danger action_confirm" data-method="get">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@stop
