<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'QuestionaireController@index');
Route::resource('questionaire', 'QuestionaireController');
Route::post('back', 'QuestionaireController@back')->name('top-back');
Route::get('/pdf', 'DocumentController@downloadPdf');
Route::get('excel', 'QuestionaireController@func');
Route::post('excelout', 'QuestionaireController@jstore')->name('excelout');


//Route::get('import', 'CSVimportsController@import')->name('csvimport_import');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'sys/{id}'], function () {
    });
    Route::resource('sys', 'UsersController', ['only' => ['index']]);
    // アンケート結果確認
    Route::get('rept/{sys}', 'UsersController@rept')->name('sys.rept');
    Route::get('rept3/{sys}', 'UsersController@rept3')->name('sys.rept3');
    Route::post('rept2', 'DocumentController@downloadPdf2')->name('sys.rept2');
    Route::post('questore', 'QuestionaireController@questore')->name('questore');
    // アンケート設定
    Route::get('show/{sys}', 'UsersController@show')->name('sys.show');
    Route::post('questore', 'QuestionaireController@questore')->name('questore');
    // アンケート対象者取り込み
    Route::get('ushow/{sys}', 'UsersController@ushow')->name('sys.ushow');
    Route::post('ustore', 'QuestionaireController@ustore')->name('ustore');
    Route::post('rep_pdf', 'DocumentController@downloadPdf2')->name('rep_pdf');
    //アンケート対象者ＣＳＶ取り込み
    Route::post('ushow/import', 'CSVimportsController@import')->name('ushow.csvimport_import');
    //アンケート対象者ＣＳＶサンプルダウンロード
    Route::get("/download/{file}", function ($file="") {
        return response()->download(storage_path("public/".$file));
    });
    // アンケート対象者取り込み
    Route::get('qlshow/{sys}', 'UsersController@qlshow')->name('sys.qlshow');
    Route::post('qlshow/import', 'CSVimportsController@qlimport')->name('qlshow.csvimport_import');
});
Route::get('hello', 'HelloController@index');
Route::get('cvsimp', 'CSVimportsController@index');

