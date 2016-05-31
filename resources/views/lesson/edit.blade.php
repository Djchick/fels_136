@extends('layouts.app')
@section('title')
    {{ trans('lesson/labels.update_lesson') }}
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
                            <small>{{ trans('lesson/labels.update_lesson') }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7">
                        @include('errors.errors')
                        {!! Form::open(['route' => ['lesson.update', $editLesson['id']], 'method' => 'PUT']) !!}
                            <div class="form-group">
                                {!! Form::label('name', trans('lesson/labels.name'), ['class' => 'required']) !!}
                                {!! Form::text('name', old('name', isset($editLesson) ? $editLesson['name'] : null), ['class' => 'form-control', 'placeholder' => trans('lesson/placeholders.name')]) !!}
                            </div>
                            {!! Form::submit(trans('lesson/labels.update_lesson'), ['class' => 'btn btn-default']) !!}
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
