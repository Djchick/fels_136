@extends('layouts.app')
@section('title')
    {{ trans('lesson/labels.page_edit_lesson') }}
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
                            <small>{{ trans('lesson/labels.page_edit_lesson') }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7">
                        {!! Form::open(['route' => ['admin.lesson.update', $lesson['id']], 'method' => 'PUT']) !!}
                        @include('errors.errors')
                        <div class="form-group">
                            {!! Form::label('name', trans('lesson/labels.name'), ['class' => 'required']) !!}
                            {!! Form::text('name', old('name', isset($lesson) ? $lesson['name'] : null), ['class' => 'form-control', 'placeholder' => trans('lesson/placeholders.name')]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('category_id', trans('lesson/labels.category_id'), ['class' => 'required']) !!}
                            {{ Form::select('category_id', $categories,isset($lesson) ? $lesson['category_id'] : null,['class' => 'form-control']) }}
                        </div>

                        {!! Form::submit(trans('lesson/labels.add_lesson'), ['class' => 'btn btn-default']) !!}
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