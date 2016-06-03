@extends('layouts.app')
@section('title')
    {{ trans('user/labels.change_password') }}
@stop
@section('content')
    @if (Auth::guest())
        <div class="container">
            <div class="content">
                <div class="title title-home">{{ trans('user/messages.wellcome_home') }}</div>
                <p class="center">{{ trans('user/messages.wellcome_login') }}</p>
            </div>
        </div>
    @else
        <div id="wrapper">
            <!-- Navigation -->
            <div class="content_page">
                @include('layouts.sidebar')
            </div>

            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <small>{{ trans('user/labels.change_password') }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7">
                        @include('errors.errors')
                        {!! Form::open(['route' => ['user.postChangePassword'], 'method' => 'POST']) !!}
                            <div class="form-group">
                                {!! Form::label('current_password', trans('user/labels.current_password')) !!}
                                {!! Form::password('current_password', ['class' => 'form-control', 'placeholder' => trans('user/placeholders.current_password')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('new_password', trans('user/labels.new_password')) !!}
                                {!! Form::password('new_password', ['class' => 'form-control', 'placeholder' => trans('user/placeholders.new_password')]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('new_password_confirmation', trans('user/labels.confirm_password'), ['class' => 'required']) !!}
                                {!! Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => trans('user/placeholders.new_password_confirmation')]) !!}
                            </div>
                        {!! Form::submit(trans('user/labels.save'), ['class' => 'btn btn-default']) !!}
                        {!! Form::close() !!}
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
        <!-- /#wrapper -->
    @endif
@endsection