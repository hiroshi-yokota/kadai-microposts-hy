@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>管理者ログイン</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'login.post']) !!}
                <div class="form-group">
                    {!! Form::label('email', 'ID') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-sign-in-alt"></i> </i> ログイン
                </button>

            {!! Form::close() !!}
        </div>
        {{-- ユーザ登録ページへのリンク --}}
        {{-- <p class="mt-2">New user? {!! link_to_route('signup.get', 'Sign up now!') !!}</p> --}}
    </div>
@endsection