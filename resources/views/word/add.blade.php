@extends('layouts.app')
@section('title')
    {{ trans('word/labels.page_add_word') }}
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
                            <small>{{ trans('word/labels.page_add_word') }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7">
                        {!! Form::open(['route' => 'admin.word.store', 'method' => 'POST']) !!}
                        @include('errors.errors')
                        <div class="form-group">
                            {!! Form::label('content', trans('word/labels.content'), ['class' => 'required']) !!}
                            {!! Form::text('content', old('name'), ['class' => 'form-control', 'placeholder' => trans('word/placeholders.content')]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('category_id', trans('lesson/labels.category_id'), ['class' => 'required']) !!}
                            {{ Form::select('category_id',$categories,null,['class' => 'form-control category_id']) }}
                        </div>
                        <div class="form-group">
                            {!! Form::label('lesson_id', trans('lesson/labels.lesson_id'), ['class' => 'required']) !!}
                            {{ Form::select('lesson_id',[],null,['class' => 'form-control lesson_id']) }}
                        </div>
                        <div class="form-group">
                            {{ trans('word/labels.answer_title') }}
                        </div>
                        @for ($i=0; $i < 3; $i++)
                            <div class="col-lg-12">
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        {!! Form::label('word_answers[content]['.$i .']', trans('word/labels.word_answer_content'), ['class' => 'required']) !!}
                                        {!! Form::text('word_answers[content]['.$i .']', null, ['class' => 'form-control', 'placeholder' => trans('word/placeholders.word_answer_content')]) !!}
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        {!! Form::label('word_answers[correct]', trans('word/labels.word_answer_correct'), ['class' => 'required']) !!}
                                        {!! Form::radio('word_answers[correct]', $i,false, ['class' => 'form-control','style'=>'box-shadow:none']) !!}
                                    </div>
                                </div>
                            </div>
                        @endfor
                        {!! Form::submit(trans('word/labels.add_word'), ['class' => 'btn btn-default']) !!}
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
                    type : "get",
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
