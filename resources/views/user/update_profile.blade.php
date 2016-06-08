@extends('layouts.app')
@section('title')
    {{ trans('user/labels.update_user') }}
@stop
@section('content')
    <div id="wrapper">

        <!-- Navigation -->
        <div class="content_page">
            @include('layouts.sidebar')
        </div>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>{{ trans('user/labels.page_edit_member') }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7">
                        @include('errors.errors')
                        {!! Form::open(['route' => ['user.postUpdateProfile'], 'method' => 'POST','files' => true]) !!}
                        <div class="form-group">
                            {!! Form::label('name', trans('user/labels.name'), ['class' => 'required']) !!}
                            {!! Form::text('name', old('name', isset($editUser) ? $editUser['name'] : null), ['class' => 'form-control', 'placeholder' => trans('user/placeholders.name')]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', trans('user/labels.email'), ['class' => 'required']) !!}
                            {!! Form::email('email', old('email', isset($editUser) ? $editUser['email'] : null), ['class' => 'form-control', 'placeholder' => trans('user/placeholders.email')]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('avatar',trans('user/labels.avatar')) !!}
                            {!! Form::file('avatar', null) !!}
                        </div>
                        <div class="form-group">
                            {{ Html::image($editUser->getUserAvatar(), $editUser->name) }}
                        </div>
                        {!! Form::submit(trans('user/labels.update_user'), ['class' => 'btn btn-default']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
@endsection