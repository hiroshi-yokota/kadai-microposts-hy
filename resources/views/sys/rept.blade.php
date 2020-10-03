@extends('layouts.app')
@section('content')
    <script src="https://www.gstatic.com/charts/loader.js"></script>
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
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">対象アンケート：</div>
                            <div class="col-md-2">
                                <select class="my_class" name="question_id" onchange="flight()" id="model">
                                    @foreach ($questions_datas as $questions_data)
                                        @if($questions_data->i_question_id == $select_no)
                                            <option value="{{ $questions_data->i_question_id }}" selected>{{ $questions_data->c_question_name }}</option>
                                        @else
                                            <option value="{{ $questions_data->i_question_id }}">{{ $questions_data->c_question_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                {!! Form::open(['route' => 'rep_pdf']) !!}
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="far fa-file-pdf"></i> 回答結果出力
                                    </button>
                                    {{Form::hidden('id', $user->id)}}
                                    {{Form::hidden('select_no', $select_no)}}
                                {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">＜＜回答結果＞＞※有効回答者の結果のみ表示。</div>
                            <div class="col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                            <table class="table table-striped table-bordered">
                                @foreach($queue as $key => $value)
                                    @foreach($value as $sub_key => $sub_value) 
                                        @if ($sub_key == "no")
                                            <tr>
                                                <td colspan=25>
                                                    <h5>{{ nl2br(e($sub_value)) }}．
                                        @elseif($sub_key == "title")
                                                    {{ nl2br(e($sub_value)) }}</h5>
                                                </td>
                                            </tr>
                                        @elseif ($sub_key == "l1")
                                            <?php $vol_flg = 0; ?>
                                            <tr>
                                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                <td>{{ nl2br(e($sub_value)) }}</td>
                                        @elseif($sub_key == "l1" or $sub_key == "l2"  or $sub_key == "l3"  or $sub_key == "l4" or
                                                $sub_key == "l5" or $sub_key == "l6"  or $sub_key == "l7"  or $sub_key == "l8" or
                                                $sub_key == "l9" or $sub_key == "l10" or $sub_key == "l11" or $sub_key == "l12")
                                                @if($sub_value == '')
                                                    <?php $vol_flg = 1; ?>
                                                @else
                                                    <?php $vol_flg = 0; ?>
                                                    <td>{{ nl2br(e($sub_value)) }}</td>
                                                @endif
                                        @elseif($sub_key == "v1" or $sub_key == "v2"  or $sub_key == "v3"  or $sub_key == "v4" or
                                                $sub_key == "v5" or $sub_key == "v6"  or $sub_key == "v7"  or $sub_key == "v8" or
                                                $sub_key == "v9" or $sub_key == "v10" or $sub_key == "v11" or $sub_key == "v12")
                                                @if(isset($vol_flg))
                                                    @if($vol_flg == 1)
                                                    @else
                                                        <td>{{ nl2br(e($sub_value)) }}</td>
                                                    @endif
                                                @endif
                                        @else
                                            <td>{{ nl2br(e($sub_value)) }}</td>
                                            </tr>
                                        @endif
                                    @endforeach

                                @endforeach       

                            </table>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
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