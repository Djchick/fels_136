@extends('layouts.app')
@section('title')
    {{ trans('activity/labels.page_list_activity') }}
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
                            <small>{{ trans('activity/labels.page_list_activity') }}</small>
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
                                <th>{{ trans('activity/labels.field_activities') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($activities as $key => $activity)
                                <tr class="even gradeC" align="left">
                                    <td>
                                        @if($activity->user)
                                            {{$activity->user->name}}
                                        @endif
                                        {{-- */$activityContent=json_decode($activity->content)/* --}}
                                        @if($activityContent->code && $activityContent->value)
                                            {{ trans('activity/labels.'.$activityContent->code,['number'=>$activityContent->value,'date'=>date("H:i d/m/Y",strtotime($activity->created_at))]) }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @include('pagination.default', ['paginator' => $activities])
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