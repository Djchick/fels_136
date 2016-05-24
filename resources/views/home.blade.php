@extends('layouts.app')
@section('title')
    {{ trans('user/labels.login') }}
@stop
@section('content')
    @if (Auth::guest())
    <div class="container">
        <div class="content">
            <div class="title title-home">{{ trans('user/messages.wellcome_home') }}</div>
            <p class="center">{{ trans('user/messages.wellcome_login') }}</p>
        </div>
    </div>
    @else
    <div id="wrapper">
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="#"><i class="fa fa-dashboard fa-fw"></i> {{ trans('user/titles.activity') }}</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> {{ trans('user/titles.category') }}<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">{{ trans('user/titles.list_category') }}</a>
                            </li>
                            @if (Auth::user()->isAdmin())
                            <li>
                                <a href="#">{{ trans('user/titles.add_category') }}</a>
                            </li>
                            @endif 
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-cube fa-fw"></i> {{ trans('user/titles.lesson') }}<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">{{ trans('user/titles.list_lesson') }}</a>
                            </li>
                            <li>
                                <a href="#">{{ trans('user/titles.add_lesson') }}</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-users fa-fw"></i> {{ trans('user/titles.word') }}<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">{{ trans('user/titles.list_word') }}</a>
                            </li>
                            <li>
                                <a href="#">{{ trans('user/titles.add_word') }}</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">{{ trans('user/titles.list_category') }}
                            <small>{{ trans('user/titles.add_category') }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7">
                        {!! Form::open(['route' => 'home', 'method' => 'POST']) !!}
                            <div class="form-group">
                                <label>{{ trans('user/titles.add_category') }}</label>
                                {!! Form::text('txtCateName', null, ['class' => 'form-control']) !!}
                            </div>
                            {!! Form::submit(trans('user/titles.add_category'), ['class' => 'btn btn-default']) !!}
                            {!! Form::submit(trans('user/titles.reset'), ['class' => 'btn btn-primary']) !!}
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
    @endif
@endsection