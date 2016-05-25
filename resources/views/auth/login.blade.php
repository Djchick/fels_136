@extends('layouts.app')
@section('title')
    {{ trans('user/labels.login') }}
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('user/labels.login') }}</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['route' => 'getLogin', 'method' => 'POST']) !!}
                            @include('errors.errors')
                            <fieldset>
                                <div class="form-group">
                                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => trans('user/placeholders.email')]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => trans('user/placeholders.password')]) !!}
                                </div>
                                {!! Form::submit(trans('user/labels.login'), ['class' => 'btn btn-lg btn-success btn-block']) !!}
                            </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection