@extends('layouts.app')

@section('content')
@if (count($questions_data) > 0)
    {!! Form::open(['route' => 'questionaire.store']) !!}
        <div class="container">
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-3">対象アンケート選択：</div>
                <div class="col-md-4">
                    <select class="my_class" name="question_id" onchange="flight()" id="model">
                        @foreach ($questions_data as $questions_data)
                            @if($select_no == $questions_data->i_question_id)
                                <option value="{{ $questions_data->i_question_id }}" selected>{{ $questions_data->c_question_name }}</option>
                            @else
                                <option value="{{ $questions_data->i_question_id }}">{{ $questions_data->c_question_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-3">回答者コード：</div>
                <div class="col-md-4">{{Form::text('taisyo_id', '', ['class' => 'form-control',"placeholder"=>"数字"])}}</div>
                <div class="col-md-3"></div>
            </div>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            @foreach ($question_lists as $question_list)
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <h5>
                        {!! $question_list->i_quest_no !!}．{!! nl2br(e($question_list->c_quest_title)) !!}
                    </h5>
                </div>
            </div>
                @if ($question_list->c_quest_type == 'radio')
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                    @for ($i = 1; $i < 13; $i++)
                        @if($question_list->{'c_quest_label'.$i} != '')
                            <input name="{!! $question_list->i_quest_no !!}:{!! $question_list->c_quest_type !!}"
                                type="radio"
                                value="{!! $question_list->{'c_quest_value'.$i} !!}">&nbsp;{!! $question_list->{'c_quest_label'.$i} !!}&nbsp;&nbsp;
                            @endif
                    @endfor
                    </div>
                </div>
                @endif
                @if ($question_list->c_quest_type == 'checkbox')
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                    @for ($i = 1; $i < 7; $i++)
                        @if($question_list->{'c_quest_value'.$i} != '')
                            <input name="{!! $question_list->i_quest_no !!}:{!! $question_list->c_quest_type !!}[]"
                                type="checkbox"
                                value="{!! $question_list->{'c_quest_value'.$i} !!}">&nbsp;{!! $question_list->{'c_quest_label'.$i} !!}&nbsp;&nbsp;
                        @endif
                    @endfor
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                    @for ($i = 7; $i < 13; $i++)
                        @if($question_list->{'c_quest_label'.$i} != '')
                            <input name="{!! $question_list->i_quest_no !!}:{!! $question_list->c_quest_type !!}[]"
                                type="checkbox"
                                value="{!! $question_list->{'c_quest_value'.$i} !!}">&nbsp;{!! $question_list->{'c_quest_label'.$i} !!}&nbsp;&nbsp;
                        @endif
                    @endfor
                    </div>
                </div>
                @endif
                @if ($question_list->c_quest_type == 'text')
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                    <input name="{!! $question_list->i_quest_no !!}:{!! $question_list->c_quest_type !!}"
                                type="textarea">&nbsp;
                    </div>
                </div>
                @endif
                @if ($question_list->c_quest_type == 'select')
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-9">
                        <select class="my_class" name="{!! $question_list->i_quest_no !!}:{!! $question_list->c_quest_type !!}">&nbsp;
                            <option value="non" selected>－ 選択してください －</option>
                            @for ($i = 1; $i < 13; $i++)
                                @if($question_list->{'c_quest_label'.$i} != '')
                                    @if($i == 1)
                                        <option value="{!! $question_list->{'c_quest_value'.$i} !!}">{!! $question_list->{'c_quest_label'.$i} !!}</option>
                                    @else
                                        <option value="{!! $question_list->{'c_quest_value'.$i} !!}">{!! $question_list->{'c_quest_label'.$i} !!}</option>
                                    @endif
                                @endif
                            @endfor
                        </select>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary btn-block btn-success">
                    <i class="fas fa-share-square"></i> 回答
                    </button>
                </div>
                <div class="col-md-3"></div>
            </div>
    {!! Form::close() !!}
@else
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <span style='color:red'>只今、実施しているアンケートはありません。</span>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endif
    <script language="javascript" type="text/javascript">
      // イベントハンドラー
      function flight() {
        var model = document.getElementById("model").value;
        var message = "";
        if(model) {
//            alert("デバッグ);
            location.href = "./" + "?idd=" + model;
        }
      }
    </script>
@endsection