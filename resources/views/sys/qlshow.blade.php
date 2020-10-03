@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            {{-- タブ --}}
            @include('sys.navtabs')
            @if (Auth::id() == $user->id)
            @if (count($questions_datas) == 0)
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span style='color:red'>只今、実施しているアンケートはありません。</span>
                            </div>
                        </div>
                    </div>
            @else
            {{--            {!! Form::open(['route' => 'questore']) !!} --}}
            <form action="import" method="post" enctype="multipart/form-data">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">対象アンケート：</div>
                            <div class="col-md-2">
                                <select class="my_class" name="question_id" onchange="flight()" id="model">
                                    @foreach ($questions_datas as $questions_data)
                                        @if($select_no == $questions_data->i_question_id)
                                            <option value="{{ $questions_data->i_question_id }}" selected>{{ $questions_data->c_question_name }}</option>
                                        @else
                                            <option value="{{ $questions_data->i_question_id }}">{{ $questions_data->c_question_name }}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-1">
                            </div>
                            <div class="col-md-7">
                                {{ csrf_field() }}
                                <div class="d-flex justify-content-start">
                                    <input type="file" name="csv_file" id="csv_file">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default btn-success">
                                            <i class="fas fa-file-import"></i> 設問データ登録
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-7">
                                <a href="/download/sample_setumon.csv"><i class="fas fa-file-csv"></i>取り込みファイルサンプル(ＣＳＶ)</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-7">
                                ※メモ帳などのテキストエディターで開いて編集してください。
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">＜設問データ表示＞</div>
                            <div class="col-md-8"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"></div>
                            {{-- 表を出力する --}}
                            <div id="spreadsheet" style="height: 200px;"></div>
                            <script>
                                var spreadsheetdata = [
                                @foreach ($question_lists as $question_list)
                                  {"'i_quest_no": "{!! nl2br(e($question_list->i_quest_no)) !!}",
                                   "c_quest_type": "{!! nl2br(e($question_list->c_quest_type)) !!}",
                                   "c_quest_title": "{!! nl2br(e($question_list->c_quest_title)) !!}",
                                   "c_quest_label1": "{!! nl2br(e($question_list->c_quest_label1)) !!}",
                                   "c_quest_label2": "{!! nl2br(e($question_list->c_quest_label2)) !!}",
                                   "c_quest_label3": "{!! nl2br(e($question_list->c_quest_label3)) !!}",
                                   "c_quest_label4": "{!! nl2br(e($question_list->c_quest_label4)) !!}",
                                   "c_quest_label5": "{!! nl2br(e($question_list->c_quest_label5)) !!}",
                                   "c_quest_label6": "{!! nl2br(e($question_list->c_quest_label6)) !!}",
                                   "c_quest_label7": "{!! nl2br(e($question_list->c_quest_label7)) !!}",
                                   "c_quest_label8": "{!! nl2br(e($question_list->c_quest_label8)) !!}",
                                   "c_quest_label9": "{!! nl2br(e($question_list->c_quest_label9)) !!}",
                                   "c_quest_label10": "{!! nl2br(e($question_list->c_quest_label10)) !!}",
                                   "c_quest_label11": "{!! nl2br(e($question_list->c_quest_label11)) !!}",
                                   "c_quest_label12": "{!! nl2br(e($question_list->c_quest_label12)) !!}"
                                  },
                                @endforeach
                                  ]
                                var trexplist = jexcel(document.getElementById('spreadsheet'),{
                                    data: spreadsheetdata,
                                    minSpareRows: 0,
                                    columns: [
                                        { type: 'text', title:'Ｎｏ．'    , width:50 , align: 'left'},
                                        { type: 'text', title:'Type'    , width:90 , align: 'left'},
                                        { type: 'text', title:'設問内容'    , width:300 , align: 'left'},
                                        { type: 'text', title:'設問1'    , width:100 , align: 'left'},
                                        { type: 'text', title:'設問2'    , width:100 , align: 'left'},
                                        { type: 'text', title:'設問3'    , width:100 , align: 'left'},
                                        { type: 'text', title:'設問4'    , width:100 , align: 'left'},
                                        { type: 'text', title:'設問5'    , width:100 , align: 'left'},
                                        { type: 'text', title:'設問6'    , width:100 , align: 'left'},
                                        { type: 'text', title:'設問7'    , width:100 , align: 'left'},
                                        { type: 'text', title:'設問8'    , width:100 , align: 'left'},
                                        { type: 'text', title:'設問9'    , width:100 , align: 'left'},
                                        { type: 'text', title:'設問10'    , width:100 , align: 'left'},
                                        { type: 'text', title:'設問11'    , width:100 , align: 'left'},
                                        { type: 'text', title:'設問12'    , width:100 , align: 'left'}
                                    ]
                                });
                            </script>
                        </div>
                    </div>
                    {{-- Form::hidden('id', $user->id) --}}
                    {{-- {!! Form::close() !!} --}}
                @endif
            @endif
            </form>
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