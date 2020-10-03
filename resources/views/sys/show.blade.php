@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{-- タブ --}}
            @include('sys.navtabs')
            @if (Auth::id() == $user->id)
            {{--    @if (count($questions_datas) > 0) --}}
                    {!! Form::open(['route' => 'questore']) !!}
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Ｎｏ.：</div>
                            <div class="col-md-2">
                                <select class="my_class" name="question_id" onchange="flight()" id="model">
                                    @if($select_no == 'New')
                                        <option value="New" selected>新規追加</option>
                                    @else
                                        <option value="New">新規追加</option>
                                    @endif
                                    @foreach ($questions_datas as $questions_data)
                                        @if ($select_no == $questions_data->i_question_id)
                                            <option value="{{ $questions_data->i_question_id }}" selected>{{ $questions_data->i_question_id }}</option>
                                        @else
                                            <option value="{{ $questions_data->i_question_id }}">{{ $questions_data->i_question_id }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-8">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">名称：</div>
                            <div class="col-md-4">
                                {{Form::text('quest_name', $question_name, ['class' => 'form-control',"placeholder"=>"アンケート名称"])}}
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">期間：</div>
                            <div class="col-md-2">
                                {{Form::text('quest_ymd_ji', $question_ymd_start, ['class' => 'form-control',"placeholder"=>"yyyy-mm-dd"])}}
                            </div>
                            <div class="col-md-1">～</div>
                            <div class="col-md-2">
                                {{Form::text('quest_ymd_ita', $question_ymd_end, ['class' => 'form-control',"placeholder"=>"yyyy-mm-dd"])}}
                            </div>
                            <div class="col-md-5">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"></div>
                        <div class="col-md-2">
                                 <input type="submit"  name="ques_btn"   value="登録／更新" class = "btn btn-primary btn-block">
                            </div>
                            <div class="col-md-2">
                                <input  type="submit"  name="ques_btn"  value="削除" class = "btn btn-danger btn-block">
                            </div>    
                            <div class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">＜登録済みアンケート表示＞</div>
                            <div class="col-md-8"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"></div>
                            {{-- 表を出力する --}}
                            <div id="spreadsheet" style="height: 200px;"></div>
                            <script>

                                var spreadsheetdata = [
                                @foreach ($questions_datas as $questions_data)
                                  {"quest_id": "{!! nl2br(e($questions_data->i_question_id)) !!}",
                                    "quest_id2": "{!! nl2br(e($questions_data->c_question_name)) !!}",
                                    "quest_id3": "{!! nl2br(e($questions_data->c_question_ymd_start)) !!}",
                                    "quest_id4": "{!! nl2br(e($questions_data->c_question_ymd_end)) !!}"
                                  },
                                @endforeach
                                  ]

                                var trexplist = jexcel(document.getElementById('spreadsheet'),{
                                    data: spreadsheetdata,
                                    minSpareRows: 0,
                                    columns: [
                                        { type: 'text', title:'Ｎｏ．'    , width:100 , align: 'left' },
                                        { type: 'text', title:'アンケート名称'    , width:400 , align: 'left'},
                                        { type: 'text', title:'アンケート期間（自）'    , width:200 , align: 'left'},
                                        { type: 'text', title:'アンケート期間（至）'    , width:200 , align: 'left'},
                                    ]
                                });
                            </script>
                        </div>
                    </div>
                    {{Form::hidden('id', $user->id)}}
                    {!! Form::close() !!}
                @endif
            {{-- @endif --}}
        </div>
    </div>
<script language="javascript" type="text/javascript">
  // イベントハンドラー
  function flight() {
    var model = document.getElementById("model").value;
    var message = "";
    if(model) {
//            alert("デバッグ);
        location.href = "./{{ $user->id }}" + "?idd=" + model;
    }
  }
</script>
@endsection