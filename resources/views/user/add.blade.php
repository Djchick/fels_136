@extends('layouts.app')
@section('title')
    {{ trans('user/labels.login') }}
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
                            <small>{{ trans('user/labels.page_add_member') }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7">
                        {!! Form::open(['route' => 'admin.user.store', 'method' => 'POST']) !!}
                            @include('errors.errors')
                            <div class="form-group">
                                {!! Form::label('name', trans('user/labels.name'), ['class' => 'required']) !!}
                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('user/placeholders.name')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('email', trans('user/labels.email'), ['class' => 'required']) !!}
                                {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => trans('user/placeholders.email')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('password', trans('user/labels.password')) !!}
                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('user/placeholders.password')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('confirm_password', trans('user/labels.confirm_password'), ['class' => 'required']) !!}
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('user/placeholders.confirm_password')]) !!}
                            </div>
                            {!! Form::submit(trans('user/labels.add_user'), ['class' => 'btn btn-default']) !!}
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
