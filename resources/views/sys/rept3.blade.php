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
                            <div class="col-md-8">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">&nbsp;</div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="target2"></div>
                                <script>
                                (function() {
                                 'use strict';
                                     // パッケージのロード
                                    google.charts.load('current', {packages: ['corechart']});
                                     // コールバックの登録
                                    google.charts.setOnLoadCallback(drawChart);
                                    // コールバック関数の実装
                                    function drawChart() {
                                     // データの準備
                                    var data　= new google.visualization.DataTable();
                                    data.addColumn('string', 'Love');
                                    data.addColumn('number', 'Votes');
                                    data.addRow(['回答者'  , {!! nl2br(e($kaitosya_cnt)) !!}] );
                                    data.addRow(['未回答者', {!! nl2br(e($mi_taisyosya_list_cnt)) !!}] );
                                    // オプションの準備
                                    var options = {
                                        title: '回答状況',
                                        width: 500,
                                        height: 300
                                    };
                                    // 描画用インスタンスの生成および描画メソッドの呼び出し
                                    var chart = new google.visualization.PieChart(document.getElementById('target2'));
                                    chart.draw(data, options);
                                    }
                                })();
                                </script>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <script type="text/javascript">
                                    // パッケージのロード
                                    google.charts.load('current', {packages: ['corechart']});
                                    // ロード完了まで待機
                                    google.charts.setOnLoadCallback(drawChart);
                                    // コールバック関数の実装
                                    function drawChart() {
                                        // データの準備
                                        var data = google.visualization.arrayToDataTable([
                                            ['日', '日別回答数','累積値'],
                                            <?php $all_cnt = 0; ?>
                                            @foreach ($answer_day_cnt as $answer_day_cnt)
                                                <?php
                                                    $all_cnt = $all_cnt + $answer_day_cnt->days_count;
                                                ?>
                                                ['{!! nl2br(e($answer_day_cnt->days)) !!}',{!! nl2br(e($answer_day_cnt->days_count)) !!},<?php echo $all_cnt; ?>],
                                            @endforeach
                                        ]);
                                        // オプション設定
                                        var options = {
                                            title: '日毎の回答推移',
                                            seriesType: "bars",
                                            isStacked: true,
                                            series: {1: {type: "line"}}
                                        };
                                        // インスタンス化と描画
                                        var chart = new google.visualization.ComboChart(document.getElementById('target'));
                                        chart.draw(data, options);
                                    }
                                </script>
                                <div id="target"></div>
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