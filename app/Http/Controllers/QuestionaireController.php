<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;

// Mailファサードをインポート.
use Illuminate\Support\Facades\Mail;
//use Carbon\Carbon;
use App\Question;
use App\Taisyosya_list;
use App\Answer;
use App\Question_list;

class QuestionaireController extends Controller
{
    public function index(Request $request)
    {
        $now = date("Y-m-d");
        $data = [];
        if (isset($request->idd)){
                $question_list_first = Question::orderBy('i_question_id')
                                        ->where('i_question_id', '=', $request->idd)
                                        ->where('c_question_ymd_start', '<=', $now)
                                        ->where('c_question_ymd_end', '>=', $now)
                                        ->first();
                $question_list = Question_list::where('i_question_id', '=', $question_list_first->i_question_id)
                                        ->get();
                $select_no = $request->idd;
//var_dump($select_no);
        }else{
                $question_list_first = Question::orderBy('i_question_id')
                                        ->where('c_question_ymd_start', '<=', $now)
                                        ->where('c_question_ymd_end', '>=', $now)
                                        ->first();
                if($question_list_first != null){
                    $select_no = $question_list_first->i_question_id;
                    $question_list       = Question_list::where('i_question_id', '=', $question_list_first->i_question_id)->get();
                }else{
                    $select_no = 0;
                    $question_list       = Question_list::where('i_question_id', '=', '')->get();
                }
//var_dump($select_no);
        }
        // 
        $questions_data = Question::where('c_question_ymd_start', '<=', $now)
                                        ->where('c_question_ymd_end', '>=', $now)
                                        ->get(['i_question_id','c_question_name']);

//echo '<pre>' . var_export($question_list, true) . '</pre>';

        $data = [
                'select_no'      => $select_no,
                'questions_data' => $questions_data,
                'question_lists' => $question_list,
        ];
        // Welcomeビューでそれらを表示
        return view('welcome', $data);
    }
    public function store(Request $request)
    {
//dd($request);

        $answer         = new Answer;
        $taisyosya_list = new Taisyosya_list;

        $quest_id = $request->input('question_id');
        $taisyosya_id = $request->input('taisyo_id');


        // バリデーション(後回し)
        $request->validate([
            'question_id' => 'required|integer',
            'taisyo_id' => 'required|integer',
        ]);
        //設問のバリデーション
        $question_list = Question_list::where('i_question_id', '=',$quest_id)->orderBy('i_quest_no', 'asc')->get();
        foreach ($question_list as $question_list){
            if ($question_list->c_quest_type == 'checkbox'){
                $request->validate([
                    $question_list->i_quest_no.':'.$question_list->c_quest_type => 'required',
                ]);
            }elseif($question_list->c_quest_type == 'radio'){
                $request->validate([
                    $question_list->i_quest_no.':'.$question_list->c_quest_type => 'required',
                ]);
            }elseif($question_list->c_quest_type == 'select'){
                $request->validate([
                    $question_list->i_quest_no.':'.$question_list->c_quest_type => 'required|not_in:non',
                ]);
            }
        }
        // アンケート対象者か否かのCheck(テストデータはseedで1から100まで登録済み。)
        if (Taisyosya_list::where('i_question_id', $quest_id) -> where('i_taisyosha_id', $taisyosya_id)->exists()) {
            // アンケート回答済みか否かのCheck
            if (Answer::where('i_question_id', $quest_id) -> where('i_taisyosha_id', $taisyosya_id)->exists()) {
                // アンケート回答済みな為、登録しない。
                $msg_type = 'show_ng';
                return view('message_dsp' , compact('msg_type'));
            }else{
                $request_all = $request->all();

                foreach ($request_all as $key => $value){
                    if ($key == '_token'      or
                        $key == 'question_id' or
                        $key == 'taisyo_id'){
                    }else{
                        $answer         = new Answer;
                        $key_list = preg_split('/:/', $key);

//echo '<pre>' . var_export($key, true) . '</pre>';

                        // post値をテーブルに格納する。
                        $answer->i_question_id  = $quest_id;
                        $answer->i_taisyosha_id = $taisyosya_id;
                        $answer->i_quest_no     = $key_list[0];
                        $answer->update_ymd     = date("Y-m-d");
                        // チェックボックスは、配列で受け渡される為、カンマ区切りに入れ直し。

//echo '<pre>' . var_export($value, true) . '</pre>';

                        if ($key_list[1] == 'checkbox'){
                            $answer->c_quest_value  =  implode(",", $value);
                            $answer->save();
                        }elseif($key_list[1] == 'radio'){
                            $answer->c_quest_value  = $value;
                            $answer->save();
                        }elseif($key_list[1] == 'select'){
                            $answer->c_quest_value  = $value;
                            $answer->save();
                        }elseif($key_list[1] == 'text'){
                            if($value  == ''){
                            }else{
                                $answer->c_quest_value  = $value;
                                $answer->save();
                            }
                        }
                        
                    }
                }
                // メール送信対象者抽出
                $mail_to = Taisyosya_list::where('i_question_id', $quest_id) 
                                ->where('i_taisyosha_id', $taisyosya_id)
                                ->get('e_mail')->first();

                // メール送信
                $email = $mail_to->e_mail;
                $email_title = '【Questionnaire】回答確認メール';
                $mail_honbun = 'ご回答を受け付けました。'."\n".'ありがとうございました。';
                
                // クロージャ―の変数引き渡し(useで)
                Mail::raw($mail_honbun, function ($message) use ($email,$email_title)
                {
                    $message->to($email);
                    $message->subject($email_title);
                });

                //登録画面表示
                $msg_type = 'show_ok';
                return view('message_dsp' , compact('msg_type'));
            }
        }else{
            $msg_type = 'taisyosya_ng';
            return view('message_dsp' , compact('msg_type'));
        }
    }
    public function back()
    {
        return back();
    }
    public function func() 
    {
        return view('jexcel');
    }
    public function jstore(Request $request)
    {
//dd($request);
//echo '<pre>' . var_export($request, true) . '</pre>';
    }
    public function questore(Request $request)
    {

        $quest_id = $request->input('question_id');
        $ques_btn = $request->input('ques_btn');
        $quest_name = $request->input('quest_name');
        $quest_ymd_ji = $request->input('quest_ymd_ji');
        $quest_ymd_ita = $request->input('quest_ymd_ita');
        $id = $request->input('id');
        $question      = new Question;
//dd($request);
        if($ques_btn == '削除'){
            $question->where('i_question_id',$quest_id)->delete();
        }else{
            // バリデーション(後回し)
            $request->validate([
                    'quest_name' => 'required',
                    'quest_ymd_ji' => 'required|date|date_format:Y-m-d',
                    'quest_ymd_ita' => 'required|date|date_format:Y-m-d',
            ]);
            if($quest_id == 'New'){
                //新規追加
                $max_count = Question::max('i_question_id');
                $question->insert([
                    'i_question_id'        => $max_count + 1,
                    'c_question_name'      => $quest_name,
                    'c_question_ymd_start' => $quest_ymd_ji,
                    'c_question_ymd_end'   => $quest_ymd_ita,
                ]);
            }else{
                //更新
                Question::where('i_question_id', $quest_id)
                            ->update(['c_question_name' => $quest_name,
                                      'c_question_ymd_start' => $quest_ymd_ji,
                                      'c_question_ymd_end' => $quest_ymd_ita]);
            }
        }
        // 前のURLへリダイレクトさせる
        return back();
    }
    public function questorerep(Request $request)
    {

        $quest_id = $request->input('question_id');
        $ques_btn = $request->input('ques_btn');
        $quest_name = $request->input('quest_name');
        $quest_ymd_ji = $request->input('quest_ymd_ji');
        $quest_ymd_ita = $request->input('quest_ymd_ita');
        $id = $request->input('id');
        $question      = new Question;
        if($ques_btn == '削除'){
            $question->where('i_question_id',$quest_id)->delete();
        }else{
            // バリデーション(後回し)
            $request->validate([
                    'quest_name' => 'required',
                    'quest_ymd_ji' => 'required',
                    'quest_ymd_ita' => 'required',
            ]);
            if($quest_id == 'New'){
                //新規追加
                $max_count = Question::max('i_question_id');
                $question->insert([
                    'i_question_id'        => $max_count + 1,
                    'c_question_name'      => $quest_name,
                    'c_question_ymd_start' => $quest_ymd_ji,
                    'c_question_ymd_end'   => $quest_ymd_ita,
                ]);
            }else{
                //更新
                Question::where('i_question_id', $quest_id)
                            ->update(['c_question_name' => $quest_name,
                                      'c_question_ymd_start' => $quest_ymd_ji,
                                      'c_question_ymd_end' => $quest_ymd_ita]);
            }
        }
        // 前のURLへリダイレクトさせる
        return back();
    }
}
