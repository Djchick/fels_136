@extends('layouts.app')
@section('title')
    {{ trans('word/labels.page_edit_word') }}
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
                            <small>{{ trans('word/labels.page_edit_word') }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7">
                        {!! Form::open(['route' => ['admin.word.update',$word['id']], 'method' => 'PUT']) !!}
                        @include('errors.errors')
                        <div class="form-group">
                            {!! Form::label('content', trans('word/labels.content'), ['class' => 'required']) !!}
                            {!! Form::text('content', old('content', isset($word) ? $word['content'] : null), ['class' => 'form-control', 'placeholder' => trans('word/placeholders.content')]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('category_id', trans('lesson/labels.category_id'), ['class' => 'required']) !!}
                            {{ Form::select('category_id', $categories, $word['category_id'], ['class' => 'form-control category_id']) }}
                        </div>
                        <div class="form-group">
                            {!! Form::label('lesson_id', trans('lesson/labels.lesson_id'), ['class' => 'required']) !!}
                            {{ Form::select('lesson_id', [], null, ['class' => 'form-control lesson_id','data-current' => $word['lessonWords']['lesson_id']]) }}
                        </div>
                        {!! Form::submit(trans('word/labels.update_word'), ['class' => 'btn btn-default']) !!}
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
    <script type="text/javascript">
        $(document).ready(function() {
            var lesson = $('.lesson_id');
            var getLesson = "{!! route('lesson.index') !!}";

            function getCategoryLessons(categoryId) {
                $.ajax({
                    url : getLesson,
                    type  "get",
                    data : "category_id=" + categoryId,
                    success : function(data) {
                        lesson.children("option").remove();
                        lesson.focus();
                        $.each(data, function(key, value) {
                            lesson.append($("<option></option>").attr("value", key).text(value));
                        });
                    }
                });
            }

            var categoryId = $('.category_id').val();
            getCategoryLessons(categoryId);
            $(document).on('change', '.category_id', function() {
                getCategoryLessons($(this).val());
            })
        });
    </script>
@endsection