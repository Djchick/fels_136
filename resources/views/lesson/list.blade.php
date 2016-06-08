@extends('layouts.app')
@section('title')
    {{ trans('lesson/labels.page_list_lesson') }}
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
                            <small>{{ trans('lesson/titles.page_list_lesson') }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        @include('errors.errors')
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr align="center">
                            <th>{{ trans('lesson/labels.field_id') }}</th>
                            <th>{{ trans('lesson/labels.field_name') }}</th>
                            <th>{{ trans('lesson/labels.field_belong_category') }}</th>
                            @if (Auth::user()->isAdmin())
                            <th>{{ trans('lesson/labels.field_delete') }}</th>
                            <th>{{ trans('lesson/labels.field_edit') }}</th>
                            @else
                                <th>{{ trans('lesson/labels.field_action') }}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($lessons as $key => $lesson)
                            <tr class="even gradeC" align="center">
                                <td>{{ $key + 1 }}</td>
                                <td>{!! $lesson["name"] !!}</td>
                                <td>
                                    {{ isset($lesson["category"]) ? $lesson["category"]["name"] : $lesson["category_id"] }}
                                </td>
                                @if (Auth::user()->isAdmin())
                                {!! Form::open(['route' => ['admin.lesson.destroy', $lesson['id']], 'method' => 'DELETE']) !!}
                                <td class="center">
                                    {{ Form::button("<i class=\"fa fa-trash-o  fa-fw\"></i>", [
                                        'class' => 'btn btn-danger',
                                        'onclick' => "return confirm('" . trans('lesson/messages.confirm_delete') . "')",
                                        'type' => 'submit',
                                    ]) }}
                                </td>
                                {!! Form::close() !!}
                                <td class="center">
                                    <i class="fa fa-pencil fa-fw"></i>
                                    <a href="{!! route('admin.lesson.edit', $lesson['id']) !!}">{{ trans('lesson/labels.field_edit') }}</a>
                                </td>
                                @else
                                    <td class="center">
                                        <i class="fa fa-hourglass-start fa-fw"></i>
                                        <a href="{!! route('word.startLearning',['lesson_id'=>$lesson['id']]) !!}">{{ trans('lesson/labels.start_learning') }}</a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @include('pagination.default', ['paginator' => $lessons])
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
@endsection