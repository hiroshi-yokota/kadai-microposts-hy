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
                                            <i class="fas fa-file-import"></i> 対象者データ登録
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5"></div>
                            <div class="col-md-7">
                                <a href="/download/sample.csv"><i class="fas fa-file-csv"></i>取り込みファイルサンプル(ＣＳＶ)</a>
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
                            <div class="col-md-4">＜対象者表示＞</div>
                            <div class="col-md-8"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"></div>
                            {{-- 表を出力する --}}
                            <div id="spreadsheet" style="height: 200px;"></div>
                            <script>
                                var spreadsheetdata = [
                                @foreach ($taisyosya_lists as $taisyosya_list)
                                  {"quest_id": "{!! nl2br(e($taisyosya_list->i_question_id)) !!}",
                                   "taisyosya_id": "{!! nl2br(e($taisyosya_list->i_taisyosha_id)) !!}",
                                   "quest_id3": "{!! nl2br(e($taisyosya_list->c_taisyosha_name_sei)) !!}",
                                   "quest_id4": "{!! nl2br(e($taisyosya_list->c_taisyosha_name_mei)) !!}",
                                   "quest_id5": "{!! nl2br(e($taisyosya_list->e_mail)) !!}"
                                  },
                                @endforeach
                                  ]

                                var trexplist = jexcel(document.getElementById('spreadsheet'),{
                                    data: spreadsheetdata,
                                    minSpareRows: 0,
                                    columns: [
                                        { type: 'text', title:'Ｎｏ．'    , width:100 , align: 'left' },
                                        { type: 'text', title:'対象者ID'    , width:100 , align: 'left'},
                                        { type: 'text', title:'対象者（姓）'    , width:300 , align: 'left'},
                                        { type: 'text', title:'対象者（名）'    , width:300 , align: 'left'},
                                        { type: 'text', title:'eメールアドレス'    , width:300 , align: 'left'},                                        
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