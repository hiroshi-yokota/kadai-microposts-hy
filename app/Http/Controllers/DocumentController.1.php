<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCPDF;
use App\User;
use App\Question;
use App\Taisyosya_list;
use App\Answer;

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
        // アンケート一覧
        $questions_data = Question::where('i_question_id', '=', "1")->first();
        //回答データ全件
        $answers_data = Answer::where('i_question_id', '=', "1")->orderBy('i_quest_no', 'asc')->get();

        //回答者件数
        $kaitosya_cnt = Answer::where('i_question_id', '=', "1")->groupby('i_taisyosha_id')->count();
//var_dump($kaitosya_cnt);
        //未回答者対象者数
        $taisyosya_list_cnt = $taisyosya_list = Taisyosya_list::where('i_question_id', '=', "1")->count();
        $mi_taisyosya_list_cnt = $taisyosya_list_cnt - $kaitosya_cnt;
//var_dump($taisyosya_list_cnt);

        //設問１
        $setumon1_1 =  Answer::where('i_question_id', '=', "1")->where('i_quest_no', '=', "1")->where('c_quest_value', '=', "1")->count();
        $setumon1_2 =  Answer::where('i_question_id', '=', "1")->where('i_quest_no', '=', "1")->where('c_quest_value', '=', "2")->count();
        $setumon1_kei = $setumon1_1 + $setumon1_2;
        $setumon1_1_per = round($setumon1_1 / $setumon1_kei * 100);
        $setumon1_2_per = round($setumon1_2 / $setumon1_kei * 100);

        //設問２
        $setumon2_1 =  Answer::where('i_question_id', '=', "1")->where('i_quest_no', '=', "2")->where('c_quest_value', 'like', "%1%")->count();
        $setumon2_2 =  Answer::where('i_question_id', '=', "1")->where('i_quest_no', '=', "2")->where('c_quest_value', 'like', "%2%")->count();
        $setumon2_3 =  Answer::where('i_question_id', '=', "1")->where('i_quest_no', '=', "2")->where('c_quest_value', 'like', "%3%")->count();
        $setumon2_4 =  Answer::where('i_question_id', '=', "1")->where('i_quest_no', '=', "2")->where('c_quest_value', 'like', "%4%")->count();
        $setumon2_5 =  Answer::where('i_question_id', '=', "1")->where('i_quest_no', '=', "2")->where('c_quest_value', 'like', "%5%")->count();
        $setumon2_kei = Answer::where('i_question_id', '=', "1")->where('i_quest_no', '=', "2")->count();
        $setumon2_1_per = round($setumon2_1 / $setumon2_kei * 100);
        $setumon2_2_per = round($setumon2_2 / $setumon2_kei * 100);
        $setumon2_3_per = round($setumon2_3 / $setumon2_kei * 100);
        $setumon2_4_per = round($setumon2_4 / $setumon2_kei * 100);
        $setumon2_5_per = round($setumon2_5 / $setumon2_kei * 100);

        //設問３
        $setumon3_1 =  Answer::where('i_question_id', '=', "1")->where('i_quest_no', '=', "3")->where('c_quest_value', '=', "1")->count();
        $setumon3_2 =  Answer::where('i_question_id', '=', "1")->where('i_quest_no', '=', "3")->where('c_quest_value', '=', "2")->count();
        $setumon3_3 =  Answer::where('i_question_id', '=', "1")->where('i_quest_no', '=', "3")->where('c_quest_value', '=', "3")->count();
        $setumon3_kei = $setumon3_1 + $setumon3_2 + $setumon3_3;
        $setumon3_1_per = round($setumon3_1 / $setumon3_kei * 100);
        $setumon3_2_per = round($setumon3_2 / $setumon3_kei * 100);
        $setumon3_3_per = round($setumon3_3 / $setumon3_kei * 100);

        //設問４

        //設問５
        $setumon5_1 =  Answer::where('i_question_id', '=', "1")->where('i_quest_no', '=', "5")->where('c_quest_value', 'like', "%1%")->count();
        $setumon5_2 =  Answer::where('i_question_id', '=', "1")->where('i_quest_no', '=', "5")->where('c_quest_value', 'like', "%2%")->count();
        $setumon5_3 =  Answer::where('i_question_id', '=', "1")->where('i_quest_no', '=', "5")->where('c_quest_value', 'like', "%3%")->count();
        $setumon5_4 =  Answer::where('i_question_id', '=', "1")->where('i_quest_no', '=', "5")->where('c_quest_value', 'like', "%4%")->count();
        $setumon5_kei = Answer::where('i_question_id', '=', "1")->where('i_quest_no', '=', "5")->count();
        $setumon5_1_per = round($setumon5_1 / $setumon5_kei * 100);
        $setumon5_2_per = round($setumon5_2 / $setumon5_kei * 100);
        $setumon5_3_per = round($setumon5_3 / $setumon5_kei * 100);
        $setumon5_4_per = round($setumon5_4 / $setumon5_kei * 100);

        //投稿推移
        $answer_day_cnt = DB::table('answers')
                     ->select(DB::raw('count(*) as days_count,SUBSTRING(created_at,1,10) as days'))
                     ->where('i_question_id', '=', 1)
                     ->groupBy('days')
                     ->get();
       // フォント、スタイル、サイズ をセット
       $this->pdf->setFont('kozminproregular','',10);
       // ページを追加
       $this->pdf->addPage();
       // HTMLを描画、viewの指定と変数代入
       $this->pdf->writeHTML(
            view('sys.rept2', [
                'user'               => $user,
                'questions_datas'    => $questions_data,
                'answers_data'       => $answers_data,
                'mi_taisyosya_list_cnt' => $taisyosya_list_cnt,
                'kaitosya_cnt'       => $kaitosya_cnt,
                'setumon1_1_per'       => $setumon1_1_per,
                'setumon1_2_per'       => $setumon1_2_per,
                'setumon2_1_per'       => $setumon2_1_per,
                'setumon2_2_per'       => $setumon2_2_per,
                'setumon2_3_per'       => $setumon2_3_per,
                'setumon2_4_per'       => $setumon2_4_per,
                'setumon2_5_per'       => $setumon2_5_per,
                'setumon3_1_per'       => $setumon3_1_per,
                'setumon3_2_per'       => $setumon3_2_per,
                'setumon3_3_per'       => $setumon3_3_per,
                'setumon5_1_per'       => $setumon5_1_per,
                'setumon5_2_per'       => $setumon5_2_per,
                'setumon5_3_per'       => $setumon5_3_per,
                'setumon5_4_per'       => $setumon5_4_per,
                'answer_day_cnt'       => $answer_day_cnt,
                
        ])
           ->render());
       // 出力の指定です、ファイル名、拡張子、Dはダウンロードを意味します。
       $this->pdf->output('AnkRep' . '.pdf', 'I');
       return;
   }
}