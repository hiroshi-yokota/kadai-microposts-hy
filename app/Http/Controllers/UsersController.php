<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Question;
use App\Taisyosya_list;
use App\Answer;
use App\Question_list;

class UsersController extends Controller
{
    public function index()
    {
        // ユーザ一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);

        // ユーザ一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    public function rept(Request $request,$id)
    {
        if (isset($request->idd)){
                $questions_data = Question::where('i_question_id', '=', $request->idd)->get();
                $select_no = $request->idd;
        }else{
                $question_list_first = Question::orderBy('i_question_id')->first();
                if($question_list_first != null){
                        $select_no = $question_list_first->i_question_id;
                        $questions_data       = Question::where('i_question_id', '=', $question_list_first->i_question_id)->get();
                }else{
                        $select_no = 0;
                        $questions_data       = Question::where('i_question_id', '=', '')->get();
                }
        }
        
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // アンケート一覧
        $questions_data = Question::all();
        //回答データ全件
        $answers_data = Answer::where('i_question_id', '=', $select_no)->orderBy('i_quest_no', 'asc')->get();

        //回答者件数
        $kaitosya_cnt = Answer::where('i_question_id', '=', $select_no)->groupby('i_taisyosha_id')->count();
//var_dump($kaitosya_cnt);
        //未回答者対象者数
        $taisyosya_list_cnt = $taisyosya_list = Taisyosya_list::where('i_question_id', '=', $select_no)->count();
        $mi_taisyosya_list_cnt = $taisyosya_list_cnt - $kaitosya_cnt;
//var_dump($taisyosya_list_cnt);

        $question_list_mst = Question_list::where('i_question_id', '=', $select_no)->orderBy('i_quest_no','asc')->get();
        //dd($question_list_mst);

        $queue = array (0,1,2,3,4,5,6,7,8,9,10,11);
        $queue = array ();
        foreach ($question_list_mst as $question_list_mst){
                if($question_list_mst->c_quest_type == 'radio'    or
                   $question_list_mst->c_quest_type == 'select'   or
                   $question_list_mst->c_quest_type == 'checkbox'){
                        if($question_list_mst->c_quest_type == 'checkbox'){
                                $vol1 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->whereRaw("find_in_set(1,c_quest_value)")->count();
                                $vol2 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->whereRaw("find_in_set(2,c_quest_value)")->count();
                                $vol3 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->whereRaw("find_in_set(3,c_quest_value)")->count();
                                $vol4 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->whereRaw("find_in_set(4,c_quest_value)")->count();
                                $vol5 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->whereRaw("find_in_set(5,c_quest_value)")->count();
                                $vol6 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->whereRaw("find_in_set(6,c_quest_value)")->count();
                                $vol7 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->whereRaw("find_in_set(7,c_quest_value)")->count();
                                $vol8 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->whereRaw("find_in_set(8,c_quest_value)")->count();
                                $vol9 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->whereRaw("find_in_set(9,c_quest_value)")->count();
                                $vol10 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->whereRaw("find_in_set(10,c_quest_value)")->count();
                                $vol11 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->whereRaw("find_in_set(11,c_quest_value)")->count();
                                $vol12 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->whereRaw("find_in_set(12,c_quest_value)")->count();
                        }else{
                                $vol1 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->where('c_quest_value', '=', '1')->count();
                                $vol2 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->where('c_quest_value', '=', '2')->count();
                                $vol3 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->where('c_quest_value', '=', '3')->count();
                                $vol4 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->where('c_quest_value', '=', '4')->count();
                                $vol5 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->where('c_quest_value', '=', '5')->count();
                                $vol6 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->where('c_quest_value', '=', '6')->count();
                                $vol7 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->where('c_quest_value', '=', '7')->count();
                                $vol8 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->where('c_quest_value', '=', '8')->count();
                                $vol9 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->where('c_quest_value', '=', '9')->count();
                                $vol10 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->where('c_quest_value', '=', '10')->count();
                                $vol11 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->where('c_quest_value', '=', '11')->count();
                                $vol12 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                                ->where('c_quest_value', '=', '12')->count();                        
                        }
                        $setumon_kei = 0;
                        $setumon_kei = $vol1 + $vol2 + $vol3 + $vol4 + $vol5 + $vol6 + $vol7 + $vol8 + $vol9 + $vol10 + $vol11 + $vol12;
                        if($setumon_kei != 0){
                                $vol1  = round($vol1  / $setumon_kei * 100) . "％";
                                $vol2  = round($vol2  / $setumon_kei * 100) . "％";
                                $vol3  = round($vol3  / $setumon_kei * 100) . "％";
                                $vol4  = round($vol4  / $setumon_kei * 100) . "％";
                                $vol5  = round($vol5  / $setumon_kei * 100) . "％";
                                $vol6  = round($vol6  / $setumon_kei * 100) . "％";
                                $vol7  = round($vol7  / $setumon_kei * 100) . "％";
                                $vol8  = round($vol8  / $setumon_kei * 100) . "％";
                                $vol9  = round($vol9  / $setumon_kei * 100) . "％";
                                $vol10 = round($vol10 / $setumon_kei * 100) . "％";
                                $vol11 = round($vol11 / $setumon_kei * 100) . "％";
                                $vol12 = round($vol12 / $setumon_kei * 100) . "％";
                        }else{
                                $vol1  = 0 . "％";
                                $vol2  = 0 . "％";
                                $vol3  = 0 . "％";
                                $vol4  = 0 . "％";
                                $vol5  = 0 . "％";
                                $vol6  = 0 . "％";
                                $vol7  = 0 . "％";
                                $vol8  = 0 . "％";
                                $vol9  = 0 . "％";
                                $vol10 = 0 . "％";
                                $vol11 = 0 . "％";
                                $vol12 = 0 . "％";
                        }
                }elseif($question_list_mst->c_quest_type == 'text'){
                        $vol1 =  Answer::where('i_question_id', '=', $select_no)->distinct()
                        ->where('i_quest_no', '=', $question_list_mst->i_quest_no)->get('c_quest_value');
                        $text_vol = "";
                        foreach ($vol1 as $vol1){
                                $text_vol = $text_vol . " " . $vol1->c_quest_value;
                        }
                        $vol1 = $text_vol;
//                        var_dump($vol1);
                }
	                $queue[] = [
			        "no"    => $question_list_mst->i_quest_no ,
			        "title" => $question_list_mst->c_quest_title ,
			        "l1"    => $question_list_mst->c_quest_label1 ,
			        "v1"    => $vol1 ,
			        "l2"    => $question_list_mst->c_quest_label2 ,
			        "v2"    => $vol2  ,
			        "l3"    => $question_list_mst->c_quest_label3 ,
			        "v3"    => $vol3  ,
        			"l4"    => $question_list_mst->c_quest_label4 ,
	        		"v4"    => $vol4  ,
		        	"l5"    => $question_list_mst->c_quest_label5 ,
			        "v5"    => $vol5  ,
        			"l6"    => $question_list_mst->c_quest_label6 ,
	        		"v6"    => $vol6  ,
		        	"l7"    => $question_list_mst->c_quest_label7 ,
			        "v7"    => $vol7  ,
        			"l8"    => $question_list_mst->c_quest_label8 ,
	        		"v8"    => $vol8  ,
		        	"l9"    => $question_list_mst->c_quest_label9 ,
			        "v9"    => $vol9  ,
        			"l10"    => $question_list_mst->c_quest_label10 ,
	        		"v10"    => $vol10 ,
		        	"l11"    => $question_list_mst->c_quest_label11 ,
			        "v11"    => $vol11 ,
        			"l12"    => $question_list_mst->c_quest_label12 ,
	        		"v12"    => $vol12 
		                ];
        }
        //配列終了
//echo '<pre>' . var_export($queue, true) . '</pre>';
        //投稿推移
        $answer_day_cnt = DB::table('answers')
                     ->select(DB::raw('count(*) as days_count,SUBSTRING(created_at,1,10) as days'))
                     ->where('i_question_id', '=', $select_no)
                     ->groupBy('days')
                     ->get();
//echo '<pre>' . var_export($answer_day_cnt, true) . '</pre>';
//        $answers_data = select(Answer::raw('count(*) as count'))->groupby('i_quest_no')->orderBy('i_quest_no', 'asc')->get();
//select(DB::raw('DATE_FORMAT(day, "%Y-%m") as yearmonth'), DB::raw('count(*) as count'), DB::raw('count(*) * 2000 as total'))

//var_dump($questions_data);
        // ユーザ詳細ビューでそれらを表示
        return view('sys.rept', [
                'select_no'         => $select_no,
                'user'               => $user,
                'questions_datas'    => $questions_data,
                'answers_data'       => $answers_data,
                'mi_taisyosya_list_cnt' => $taisyosya_list_cnt,
                'kaitosya_cnt'       => $kaitosya_cnt,
                'answer_day_cnt'       => $answer_day_cnt,
                'queue'                => $queue,
        ]);
    }
    public function show(Request $request,$id)
    {
        if (isset($request->idd)){
                $questions_data = Question::where('i_question_id', '=', $request->idd)->first();
                $select_no = $request->idd;
//dd($questions_data->c_question_name);
                if($request->idd == 'New'){
                        $question_name      = '';
                        $question_ymd_start = '';
                        $question_ymd_end   = '';                       
                }elseif($questions_data != null){
                        $question_name      = $questions_data->c_question_name;
                        $question_ymd_start = $questions_data->c_question_ymd_start;
                        $question_ymd_end   = $questions_data->c_question_ymd_end;
                }else{
                        $question_name      = '';
                        $question_ymd_start = '';
                        $question_ymd_end   = '';                        
                }
//var_dump($select_no);
        }else{
                $select_no = "New";
                $question_name      = '';
                $question_ymd_start = '';
                $question_ymd_end   = '';
//dd($select_no);
//var_dump("初回");
//var_dump($select_no);
        }
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        $questions_data = Question::all();
//var_dump($questions_data);
        // ユーザ詳細ビューでそれらを表示
        return view('sys.show', [
                'select_no'       => $select_no,
                'question_name'      => $question_name,
                'question_ymd_start' => $question_ymd_start,
                'question_ymd_end'   => $question_ymd_end,
                'user'            => $user,
                'questions_datas' => $questions_data,
        ]);
    }
    public function ushow(Request $request,$id)
    {
        if (isset($request->idd)){
                $questions_data = Question::where('i_question_id', '=', $request->idd)->get();
                $select_no = $request->idd;
//var_dump($select_no);
        }else{
                $question_list_first = Question::orderBy('i_question_id')->first();
                if($question_list_first != null){
                        $select_no = $question_list_first->i_question_id;
                        $questions_data       = Question::where('i_question_id', '=', $question_list_first->i_question_id)->get();
                }else{
                        $select_no = 0;
                        $questions_data       = Question::where('i_question_id', '=', '')->get();
                }
        }
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        $questions_data = Question::all();
//var_dump($questions_data);

// join 対象者一覧の取得
//        $taisyosya_list = Taisyosya_list::all()->join('questions', 'taisyosya_lists.i_question_id', '=', 'questions.i_question_id');
//        $taisyosya_list = Taisyosya_list::all();
        $taisyosya_list = Taisyosya_list::where('i_question_id', '=', $select_no)->get();
//var_dump($taisyosya_list);
        // ユーザ詳細ビューでそれらを表示
        return view('sys.ushow', [
                'select_no'       => $select_no,
                'user'            => $user,
                'questions_datas' => $questions_data,
                'taisyosya_lists' => $taisyosya_list
        ]);
    }
    public function qlshow(Request $request,$id)
    {
        if (isset($request->idd)){
                $questions_data = Question::where('i_question_id', '=', $request->idd)->get();
                $select_no = $request->idd;
//var_dump($select_no);
        }else{
                $question_list_first = Question::orderBy('i_question_id')->first();
                if($question_list_first != null){
                        $select_no = $question_list_first->i_question_id;
                        $questions_data       = Question::where('i_question_id', '=', $question_list_first->i_question_id)->get();
                }else{
                        $select_no = 0;
                        $questions_data       = Question::where('i_question_id', '=', '')->get();
                }
        }
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        $questions_data = Question::all();
//var_dump($questions_data);

        // join 対象者一覧の取得
//        $taisyosya_list = Taisyosya_list::all()->join('questions', 'taisyosya_lists.i_question_id', '=', 'questions.i_question_id');
//        $taisyosya_list = Taisyosya_list::all();
        $question_lists  = Question_List::where('i_question_id', '=', $select_no)->get();
        
//var_dump($taisyosya_list);

        // ユーザ詳細ビューでそれらを表示
        return view('sys.qlshow', [
                'select_no'       => $select_no,
                'user'            => $user,
                'questions_datas' => $questions_data,
                'question_lists'  => $question_lists
        ]);
    }
    public function rept3(Request $request,$id)
    {
        if (isset($request->idd)){
                $questions_data = Question::where('i_question_id', '=', $request->idd)->get();
                $select_no = $request->idd;
//var_dump($select_no);
        }else{
                $question_list_first = Question::orderBy('i_question_id')->first();
                if($question_list_first != null){
                        $select_no = $question_list_first->i_question_id;
                        $questions_data       = Question::where('i_question_id', '=', $question_list_first->i_question_id)->get();
                }else{
                        $select_no = 0;
                        $questions_data       = Question::where('i_question_id', '=', '')->get();
                }
        }
        
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // アンケート一覧
        $questions_data = Question::all();
        //回答データ全件
        $answers_data = Answer::where('i_question_id', '=', $select_no)->orderBy('i_quest_no', 'asc')->get();

        //回答者件数
        $kaitosya_cnt = DB::table('answers')
                     ->select(DB::raw('distinct i_taisyosha_id'))
                     ->where('i_question_id', '=', $select_no)->get('i_taisyosha_id')
                     ->count();

//var_dump($kaitosya_cnt);

//var_dump($kaitosya_cnt);
        //未回答者対象者数
        $taisyosya_list_cnt = $taisyosya_list = Taisyosya_list::where('i_question_id', '=', $select_no)->count();

        $taisyosya_list_cnt = DB::table('taisyosya_lists')
                     ->select(DB::raw('distinct i_taisyosha_id'))
                     ->where('i_question_id', '=', $select_no)->get('i_taisyosha_id')
                     ->count();

//var_dump($taisyosya_list_cnt);

        $mi_taisyosya_list_cnt = $taisyosya_list_cnt - $kaitosya_cnt;

//var_dump($mi_taisyosya_list_cnt);

//var_dump($taisyosya_list_cnt);

        $question_list_mst = Question_list::where('i_question_id', '=', $select_no)->orderBy('i_quest_no','asc')->get();
        //dd($question_list_mst);

        $queue = array (0,1,2,3,4,5,6,7,8,9,10,11);
        $queue = array ();
        foreach ($question_list_mst as $question_list_mst){
                if($question_list_mst->c_quest_type == 'radio'    or
                   $question_list_mst->c_quest_type == 'select'   or
                   $question_list_mst->c_quest_type == 'checkbox'){

                if($question_list_mst->c_quest_type == 'checkbox'){
                        $vol1 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->whereRaw("find_in_set(1,c_quest_value)")->count();
                        $vol2 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->whereRaw("find_in_set(2,c_quest_value)")->count();
                        $vol3 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->whereRaw("find_in_set(3,c_quest_value)")->count();
                        $vol4 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->whereRaw("find_in_set(4,c_quest_value)")->count();
                        $vol5 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->whereRaw("find_in_set(5,c_quest_value)")->count();
                        $vol6 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->whereRaw("find_in_set(6,c_quest_value)")->count();
                        $vol7 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->whereRaw("find_in_set(7,c_quest_value)")->count();
                        $vol8 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->whereRaw("find_in_set(8,c_quest_value)")->count();
                        $vol9 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->whereRaw("find_in_set(9,c_quest_value)")->count();
                        $vol10 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->whereRaw("find_in_set(10,c_quest_value)")->count();
                        $vol11 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->whereRaw("find_in_set(11,c_quest_value)")->count();
                        $vol12 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->whereRaw("find_in_set(12,c_quest_value)")->count();
                }else{
                        $vol1 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->where('c_quest_value', '=', '1')->count();
                        $vol2 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->where('c_quest_value', '=', '2')->count();
                        $vol3 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->where('c_quest_value', '=', '3')->count();
                        $vol4 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->where('c_quest_value', '=', '4')->count();
                        $vol5 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->where('c_quest_value', '=', '5')->count();
                        $vol6 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->where('c_quest_value', '=', '6')->count();
                        $vol7 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->where('c_quest_value', '=', '7')->count();
                        $vol8 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->where('c_quest_value', '=', '8')->count();
                        $vol9 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->where('c_quest_value', '=', '9')->count();
                        $vol10 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->where('c_quest_value', '=', '10')->count();
                        $vol11 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->where('c_quest_value', '=', '11')->count();
                        $vol12 =  Answer::where('i_question_id', '=', $select_no)->where('i_quest_no', '=', $question_list_mst->i_quest_no)
                                        ->where('c_quest_value', '=', '12')->count();                        
                }
                        $setumon_kei = 0;
                        $setumon_kei = $vol1 + $vol2 + $vol3 + $vol4 + $vol5 + $vol6 + $vol7 + $vol8 + $vol9 + $vol10 + $vol11 + $vol12;
                        if($setumon_kei != 0){
                                $vol1  = round($vol1  / $setumon_kei * 100);
                                $vol2  = round($vol2  / $setumon_kei * 100);
                                $vol3  = round($vol3  / $setumon_kei * 100);
                                $vol4  = round($vol4  / $setumon_kei * 100);
                                $vol5  = round($vol5  / $setumon_kei * 100);
                                $vol6  = round($vol6  / $setumon_kei * 100);
                                $vol7  = round($vol7  / $setumon_kei * 100);
                                $vol8  = round($vol8  / $setumon_kei * 100);
                                $vol9  = round($vol9  / $setumon_kei * 100);
                                $vol10 = round($vol10 / $setumon_kei * 100);
                                $vol11 = round($vol11 / $setumon_kei * 100);
                                $vol12 = round($vol12 / $setumon_kei * 100);
                        }else{
                                $vol1  = 0;
                                $vol2  = 0;
                                $vol3  = 0;
                                $vol4  = 0;
                                $vol5  = 0;
                                $vol6  = 0;
                                $vol7  = 0;
                                $vol8  = 0;
                                $vol9  = 0;
                                $vol10 = 0;
                                $vol11 = 0;
                                $vol12 = 0;
                        }
	                $queue[] = [
			        "no"    => $question_list_mst->i_quest_no ,
			        "title" => $question_list_mst->c_quest_title ,
			        "l1"    => $question_list_mst->c_quest_label1 ,
			        "v1"    => $vol1 ,
			        "l2"    => $question_list_mst->c_quest_label2 ,
			        "v2"    => $vol2  ,
			        "l3"    => $question_list_mst->c_quest_label3 ,
			        "v3"    => $vol3  ,
        			"l4"    => $question_list_mst->c_quest_label4 ,
	        		"v4"    => $vol4  ,
		        	"l5"    => $question_list_mst->c_quest_label5 ,
			        "v5"    => $vol5  ,
        			"l6"    => $question_list_mst->c_quest_label6 ,
	        		"v6"    => $vol6  ,
		        	"l7"    => $question_list_mst->c_quest_label7 ,
			        "v7"    => $vol7  ,
        			"l8"    => $question_list_mst->c_quest_label8 ,
	        		"v8"    => $vol8  ,
		        	"l9"    => $question_list_mst->c_quest_label9 ,
			        "v9"    => $vol9  ,
        			"l10"    => $question_list_mst->c_quest_label10 ,
	        		"v10"    => $vol10 ,
		        	"l11"    => $question_list_mst->c_quest_label11 ,
			        "v11"    => $vol11 ,
        			"l12"    => $question_list_mst->c_quest_label12 ,
	        		"v12"    => $vol12 
		                ];
                }
        }
        //配列終了
//echo '<pre>' . var_export($queue, true) . '</pre>';
        //投稿推移
        $answer_day_cnt = DB::table('answers')
                     ->select(DB::raw('count(distinct i_taisyosha_id) as days_count,SUBSTRING(created_at,1,10) as days'))
                     ->where('i_question_id', '=', $select_no)
                     ->groupBy('days')
                     ->get();
//echo '<pre>' . var_export($answer_day_cnt, true) . '</pre>';
//        $answers_data = select(Answer::raw('count(*) as count'))->groupby('i_quest_no')->orderBy('i_quest_no', 'asc')->get();
//select(DB::raw('DATE_FORMAT(day, "%Y-%m") as yearmonth'), DB::raw('count(*) as count'), DB::raw('count(*) * 2000 as total'))

//var_dump($questions_data);
        // ユーザ詳細ビューでそれらを表示
        return view('sys.rept3', [
                'select_no'         => $select_no,
                'user'               => $user,
                'questions_datas'    => $questions_data,
                'answers_data'       => $answers_data,
                'mi_taisyosya_list_cnt' => $mi_taisyosya_list_cnt,
                'kaitosya_cnt'       => $kaitosya_cnt,
                'answer_day_cnt'       => $answer_day_cnt,
                'queue'                => $queue,
        ]);
    }
}