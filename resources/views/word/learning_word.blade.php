@extends('layouts.app')
@section('title')
    {{ trans('lesson/labels.page_learning',['name'=>$word['content']]) }}
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
                            <small>{{ trans('lesson/labels.page_learning',['name'=>$word['name']]) }}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7">
                        @include('errors.errors')
                    </div>
                    <div class="col-lg-7">
                        {!! Form::open(['route' => ['wordAnswer.update',$word['id']], 'method' => 'PUT']) !!}
                        <div class="lesson-answer">
                            @if($word->content && $word->wordAnswers)
                                <div class="word-child">
                                    <div class="row">
                                        <div class="col-xs-10 col-md-10">
                                            <div class="form-group">
                                                {!! Form::text('content',$word->content, ['class' => 'form-control', 'placeholder' => trans('word/placeholders.content'),"readonly"=>true]) !!}
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <a href="#" class="view-answers" onclick="return false">Xem</a>
                                            </div>
                                        </div>
                                    </div>
                                    @foreach ($word->wordAnswers as $key => $wordAnswer)
                                        <div class="col-lg-12 answers" style="display: none">
                                            <div class="col-lg-7">
                                                <div class="form-group">
                                                    {!! Form::hidden('word_answers[id]['.$key.']', $word->id) !!}
                                                    {!! Form::text('word_answers[content]['.$word->id.']', $wordAnswer->content, ['class' => 'form-control',"readonly"=>true, 'placeholder' => trans('word/placeholders.word_answer_content')]) !!}
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    {!! Form::radio('word_answers[correct]['.$word->id.']', $wordAnswer->id ,false, ['class' => 'form-control','style'=>'box-shadow:none']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        {!! Form::submit(trans('lesson/labels.completed'), ['class' => 'btn btn-default finish']) !!}
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
            $(".word-child:nth-child(1)").find(".answers").slideDown();
            $(document).on("click", ".finish", function() {
                var validator = true;
                $(".word-child").each(function() {
                    var checked = false;
                    $(this).find(".answers").each(function() {
                        $(this).find(".col-lg-3 .form-group").each(function() {
                            if($(this).find("input:checked").val()) {
                                checked = true;
                            }
                        });
                    });
                    if(!checked) {
                        $(".word-child").find(".answers").slideUp();
                        $(this).find(".answers").slideDown();
                        validator = false;
                        return false;
                    }
                });
                return validator;
            });
        })
    </script>
@endsection