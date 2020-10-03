@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            @if ($msg_type == 'show_ng')
                <div class="col-md-6"><span style='color:red'>既にアンケートに回答済みです。アンケートは、一度しか回答できません。</span></div>
            @elseif ($msg_type == 'show_ok')
                <div class="col-md-6"><span style='color:red'>アンケートに御回答いただき、ありがとうございました。確認の為、回答済みメールを送信しました。</span></div>
            @elseif ($msg_type == 'taisyosya_ng')
                <div class="col-md-6"><span style='color:red'>登録された回答者コードは、アンケート対象ではありません。</span></div>
            @endif
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6"><P>　</P></div>
            <div class="col-md-3"></div>
        </div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
            {!! Form::open(['action' => 'QuestionaireController@back']) !!}
                {!! Form::submit('戻る', ['class' => "btn btn-primary btn-block btn-success"]) !!}
            {!! Form::close() !!}
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection