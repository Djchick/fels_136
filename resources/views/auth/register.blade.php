@extends('layouts.app')
@section('title')
    {{ trans('user/labels.register') }}
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('user/labels.register') }}</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'getRegister', 'class' => 'form-horizontal', 'method' => 'POST']) !!}
                        @include('errors.errors')
                        <div class="form-group">
                            {!! Form::label('name', trans('user/labels.name'), ['class' => 'col-md-4 control-label required']) !!}
                            <div class="col-md-6">
                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('user/placeholders.name')]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', trans('user/labels.email'), ['class' => 'col-md-4 control-label required']) !!}
                            <div class="col-md-6">
                                {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => trans('user/placeholders.email')]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', trans('user/labels.password'), ['class' => 'col-md-4 control-label required']) !!}
                            <div class="col-md-6">
                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('user/placeholders.password')]) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('confirm_password', trans('user/labels.confirm_password'), ['class' => 'col-md-4 control-label required']) !!}
                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => trans('user/placeholders.confirm_password')]) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> {{ trans('user/labels.register') }}
                                </button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection