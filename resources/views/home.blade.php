@extends('layouts.app')
@section('title')
    {{ trans('user/labels.home') }}
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
        @include('layouts.sidebar')
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="page-header">{{ trans('user/messages.wellcome_user') }}  {{ Auth::user()->name }}</h3>
                        <h4>{{ trans('user/messages.introduce') }}</h4>
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