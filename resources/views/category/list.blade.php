@extends('layouts.app')
@section('title')
    {{ trans('category/labels.list_category') }}
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
                            <small>{{ trans('category/titles.page_list_category') }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        @include('errors.errors')
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr align="center">
                            <th>{{ trans('category/labels.field_id') }}</th>
                            <th>{{ trans('category/labels.field_name') }}</th>
                            @if (Auth::user()->isAdmin())
                                <th>{{ trans('category/labels.field_delete') }}</th>
                                <th>{{ trans('category/labels.field_edit') }}</th>
                            @endif
                            @if(Auth::user())
                                <th>{{ trans('category/labels.field_view') }}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $key => $category)
                            <tr class="even gradeC">
                                <td>{{ $key + 1 }}</td>
                                <td>{!! $category["name"] !!}</td>
                                @if (Auth::user()->isAdmin())
                                    {!! Form::open(['route' => ['admin.category.destroy', $category['id']], 'method' => 'DELETE']) !!}
                                    <td class="center">
                                        {{ Form::button("<i class=\"fa fa-trash-o  fa-fw\"></i>", [
                                            'class' => 'btn btn-danger',
                                            'onclick' => "return confirm('" . trans('category/messages.confirm_delete') . "')",
                                            'type' => 'submit',
                                        ]) }}
                                    </td>
                                    {!! Form::close() !!}
                                    <td class="center">
                                        <i class="fa fa-pencil fa-fw"></i>
                                        <a href="{!! route('admin.category.edit', $category['id']) !!}">{{ trans('category/labels.field_edit') }}</a>
                                    </td>
                                @endif
                                @if(Auth::user())
                                    <td class="center">
                                        <i class="fa fa-eye fa-fw"></i>
                                        <a href="{!! route('category.show', $category['id']) !!}">{{ trans('category/labels.field_view') }}</a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @include('pagination.default', ['paginator' => $categories])
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
@endsection