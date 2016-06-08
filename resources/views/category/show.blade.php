@extends('layouts.app')
@section('title')
    {{ trans('category/labels.page_view_category',['name'=>$category['name']]) }}
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
                            <small>{{ trans('category/labels.page_view_category',['name'=>$category['name']]) }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        @include('errors.errors')
                    </div>
                    <div class="col-sm-12">
                            <div class="modal-header">{{ trans('lesson/labels.list_lessons',['name'=>$category['name']]) }}</div>
                    </div>
                    <div class="col-lg-12">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr align="center">
                                <th class="text-left">{{ trans('lesson/labels.field_id') }}</th>
                                <th class="text-left">{{ trans('lesson/labels.field_name') }}</th>
                                <th class="text-left">{{ trans('lesson/labels.field_category') }}</th>
                                <th class="text-center">{{ trans('lesson/labels.field_action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($category['lessons'] as $key => $lesson)
                                <tr class="even gradeC" align="center">
                                    <td class="text-left">{{ $lesson['id'] }}</td>
                                    <td class="text-left">{!! $lesson["name"] !!}</td>
                                    <td class="text-left">
                                        {{ isset($lesson["category"]) ? $lesson["category"]["name"] : $lesson["category_id"] }}
                                    </td>
                                    <td class="center">
                                        <i class="fa fa-hourglass-start fa-fw"></i>
                                        <a href="{!! route('word.startLearning',['lesson_id'=>$lesson['id']]) !!}">{{ trans('lesson/labels.start_learning') }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

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