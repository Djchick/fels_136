@extends('layouts.app')
@section('title')
    {{ trans('lesson/labels.add_lesson') }}
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
                            <small>{{ trans('lesson/titles.add_lesson') }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7">
                        {!! Form::open(['route' => 'lesson.store', 'method' => 'POST']) !!}
                            @include('errors.errors')
                            <div class="form-group">
                                <label>Category Parent</label>
                                <select class="form-control">
                                    <option value="0">Please Choose Category</option>
                                    <option value="">Tin Tức</option>
                                </select>
                            </div>
                            <div class="form-group">
                                {!! Form::label('name', trans('lesson/labels.field_name'), ['class' => 'required']) !!}
                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => trans('lesson/placeholders.name')]) !!}
                            </div>
                            {!! Form::submit(trans('lesson/titles.add_lesson'), ['class' => 'btn btn-default']) !!}
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
