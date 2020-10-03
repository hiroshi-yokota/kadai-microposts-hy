<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCPDF;
use App\User;
use App\Question;
use App\Taisyosya_list;
use App\Answer;
use App\Question_list;

class DocumentController extends Controller
{
   private $pdf; // インスタンス変数を宣言

   public function __construct(TCPDF $pdf)
   {
        // コンストラクタインジェクションでTCPDFクラスをインスタンス化
       $this->pdf = $pdf;
   }
   public function downloadPdf()
   {
       // フォント、スタイル、サイズ をセット
       $this->pdf->setFont('kozminproregular','',10);
       // ページを追加
       $this->pdf->addPage();
       // HTMLを描画、viewの指定と変数代入
       $this->pdf->writeHTML(view("document.pdf", ['name' => 'PDFさん'])->render());
       // 出力の指定です、ファイル名、拡張子、Dはダウンロードを意味します。
       $this->pdf->output('test' . '.pdf', 'D');
       return;
   }
   public function downloadPdf2(Request $request)
   {
        $user = $request->input('id');
        $select_no = $request->input('select_no');
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
                     ->select(DB::raw('count(*) as days_count,SUBSTRING(created_at,1,10) as days'))
                     ->where('i_question_id', '=', $select_no)
                     ->groupBy('days')
                     ->get();
//echo '<pre>' . var_export($answer_day_cnt, true) . '</pre>';

       // フォント、スタイル、サイズ をセット
       $this->pdf->setFont('kozminproregular','',7);
       // ページを追加
       $this->pdf->addPage();
       // HTMLを描画、viewの指定と変数代入
       $this->pdf->writeHTML(
            view('sys.rept2', [
                'select_no'         => $select_no,
                'user'               => $user,
                'questions_datas'    => $questions_data,
                'answers_data'       => $answers_data,
                'mi_taisyosya_list_cnt' => $taisyosya_list_cnt,
                'kaitosya_cnt'       => $kaitosya_cnt,
                'answer_day_cnt'       => $answer_day_cnt,
                'queue'                => $queue,
        ])->render());
       // 出力の指定です、ファイル名、拡張子、Dはダウンロードを意味します。
       $this->pdf->output('AnkRep' . '.pdf', 'I');
       return;
   }
}