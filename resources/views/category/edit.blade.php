@extends('layouts.app')
@section('title')
    {{ trans('category/labels.update_category') }}
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
                            <small>{{ trans('category/labels.update_category') }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7">
                        @include('errors.errors')
                        {!! Form::open(['route' => ['admin.category.update', $category['id']], 'method' => 'PUT']) !!}
                            <div class="form-group">
                                {!! Form::label('name', trans('category/labels.name'), ['class' => 'required']) !!}
                                {!! Form::text('name', old('name', isset($category) ? $category['name'] : null), ['class' => 'form-control', 'placeholder' => trans('category/placeholders.name')]) !!}
                            </div>
                            {!! Form::submit(trans('category/labels.update_category'), ['class' => 'btn btn-default']) !!}
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
