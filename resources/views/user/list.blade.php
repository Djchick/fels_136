@extends('layouts.app')
@section('title')
    {{ trans('user/labels.login') }}
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
                            <small>{{ trans('user/labels.page_list_member') }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        @include('errors.errors')
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>{{ trans('user/labels.field_id') }}</th>
                                <th>{{ trans('user/labels.field_name') }}</th>
                                <th>{{ trans('user/labels.field_email') }}</th>
                                <th>{{ trans('user/labels.field_role') }}</th>
                                <th>{{ trans('user/labels.field_delete') }}</th>
                                <th>{{ trans('user/labels.field_edit') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $key => $item_user)
                            <tr class="even gradeC" align="center">
                                <td>{{ $key + 1 }}</td>
                                <td>{!! $item_user["name"] !!}</td>
                                <td>{!! $item_user["email"] !!}</td>
                                <td>
                                    @if ($item_user["role"] == trans('user/messages.role_user'))
                                    {{ trans('user/labels.role_member') }}
                                    @elseif ($item_user["role"] == trans('user/messages.role_admin'))
                                    {{ trans('user/labels.role_admin') }}
                                    @endif
                                </td>
                                {!! Form::open(['route' => ['admin.user.destroy', $item_user['id']], 'method' => 'DELETE']) !!}
                                <td class="center">
                                    {{ Form::button("<i class=\"fa fa-trash-o  fa-fw\"></i>", [
                                        'class' => 'btn btn-danger',
                                        'onclick' => "return confirm('" . trans('user/messages.confirm_delete') . "')",
                                        'type' => 'submit',
                                    ]) }}
                                </td>
                                {!! Form::close() !!}
                                <td class="center">
                                    <i class="fa fa-pencil fa-fw"></i> <a href="{!! route('admin.user.edit', $item_user['id']) !!}">{{ trans('user/labels.field_edit') }}</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
@endsection
