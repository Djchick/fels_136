@extends('layouts.app')
@section('title')
    {{ trans('word/labels.page_list_word') }}
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
                            <small>{{ trans('word/labels.page_list_word') }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        @include('errors.errors')
                    </div>
                    <div class="col-lg-12">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr align="center">
                                <th>{{ trans('word/labels.field_id') }}</th>
                                <th>{{ trans('word/labels.field_content') }}</th>
                                <th>{{ trans('word/labels.field_category') }}</th>
                                <th>{{ trans('word/labels.field_lesson') }}</th>
                                <th>{{ trans('word/labels.field_delete') }}</th>
                                <th>{{ trans('word/labels.field_edit') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($words as $key => $word)
                                <tr class="even gradeC" align="center">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{!! $word["content"] !!}</td>
                                    <td>
                                        {{ isset($word["category"]) ? $word["category"]["name"] : $word["category_id"] }}
                                    </td>
                                    <td>
                                        {{ isset($word["lessonWord"]) ? $word["lessonWord"]['lesson']['name'] : "" }}
                                    </td>
                                    {!! Form::open(['route' => ['admin.word.destroy', $word['id']], 'method' => 'DELETE']) !!}
                                    <td class="center">
                                        {{ Form::button("<i class=\"fa fa-trash-o  fa-fw\"></i>", [
                                            'class' => 'btn btn-danger',
                                            'onclick' => "return confirm('" . trans('word/messages.confirm_delete') . "')",
                                            'type' => 'submit',
                                        ]) }}
                                    </td>
                                    {!! Form::close() !!}
                                    <td class="center">
                                        <i class="fa fa-pencil fa-fw"></i>
                                        <a href="{!! route('admin.word.edit', $word['id']) !!}">{{ trans('word/labels.field_edit') }}</a>
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