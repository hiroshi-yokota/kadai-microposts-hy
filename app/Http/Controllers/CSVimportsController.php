<?php
 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\CSVimport;
use App\Taisyosya_list;
use App\Question_list;
//useしないと 自動的にnamespaceのパスが付与されるのでuse
use SplFileObject;
 
class CSVimportsController extends Controller
{
    protected $csvimport = null;
 
     public function __construct(CSVimport $csvimport)
    {
        $this->csvimport = $csvimport;
    }
    public function index()
    {
        return view('csv');
    }
    /**
     * CSVインポート
     *
     * @param  Request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
    if($request->file('csv_file') != null){
//    Taisyosya_list::truncate();
        Taisyosya_list::where('i_question_id', '=', $request->question_id)->delete();
        setlocale(LC_ALL, 'ja_JP.UTF-8');
        $uploaded_file = $request->file('csv_file');
        $file_path = $request->file('csv_file')->path($uploaded_file);
        $file = new SplFileObject($file_path);
        $file->setFlags(SplFileObject::READ_CSV);
     
        //配列の箱を用意
        $array = [];
        $row_count = 1;
        foreach ($file as $row)
        {
            if ($row === [null]) continue; 
            
            if ($row_count > 1)
            {
    //            $i_taisyosha_id       = mb_convert_encoding($row[0], 'UTF-8', 'SJIS');
    //            $c_taisyosha_name_sei = mb_convert_encoding($row[1], 'UTF-8', 'SJIS');
    //            $c_taisyosha_name_mei = mb_convert_encoding($row[2], 'UTF-8', 'SJIS');
    //            $e_mail               = mb_convert_encoding($row[3], 'UTF-8', 'SJIS');
                $i_taisyosha_id       = $row[0];
                $c_taisyosha_name_sei = mb_convert_encoding($row[1], 'UTF-8', 'SJIS');
                $c_taisyosha_name_mei = mb_convert_encoding($row[2], 'UTF-8', 'SJIS');
                $e_mail               = $row[3];
            
                $csvimport_array = [
                    'i_question_id'        => $request->question_id,
                    'i_taisyosha_id'       => $i_taisyosha_id,
                    'c_taisyosha_name_sei' => $c_taisyosha_name_sei, 
                    'c_taisyosha_name_mei' => $c_taisyosha_name_mei, 
                    'e_mail'               => $e_mail
                ];
                // つくった配列の箱($array)に追加
                array_push($array, $csvimport_array);
            }
            $row_count++;
        }
        //追加した配列の数を数える
        $array_count = count($array);
     
        //もし配列の数が500未満なら
        if ($array_count < 500){
     
            //配列をまるっとインポート(バルクインサート)
            Taisyosya_list::insert($array);
        } else {
            //追加した配列が500以上なら、array_chunkで500ずつ分割する
            $array_partial = array_chunk($array, 500); //配列分割
       
            //分割した数を数えて
            $array_partial_count = count($array_partial); //配列の数
     
            //分割した数の分だけインポートを繰り替えす
            for ($i = 0; $i <= $array_partial_count - 1; $i++){
                Taisyosya_list::insert($array_partial[$i]);
            }
        }
        return back();
    }else{
        return back()->with('error', '0');
    }
}
    /**
     * CSVインポート
     *
     * @param  Request
     * @return \Illuminate\Http\Response
     */
    public function qlimport(Request $request)
    {
    if($request->file('csv_file') != null){
//    Taisyosya_list::truncate();
        Question_list::where('i_question_id', '=', $request->question_id)->delete();
        setlocale(LC_ALL, 'ja_JP.UTF-8');
        $uploaded_file = $request->file('csv_file');
        $file_path = $request->file('csv_file')->path($uploaded_file);
        $file = new SplFileObject($file_path);
        $file->setFlags(SplFileObject::READ_CSV);
     
        //配列の箱を用意
        $array = [];
        $row_count = 1;

        foreach ($file as $row)
        {
            if ($row === [null]) continue; 
            
            if ($row_count > 1)
            {
    //            $i_taisyosha_id       = mb_convert_encoding($row[0], 'UTF-8', 'SJIS');
    //            $c_taisyosha_name_sei = mb_convert_encoding($row[1], 'UTF-8', 'SJIS');
    //            $c_taisyosha_name_mei = mb_convert_encoding($row[2], 'UTF-8', 'SJIS');
    //            $e_mail               = mb_convert_encoding($row[3], 'UTF-8', 'SJIS');

                $i_quest_no      = $row[0];
                $c_quest_type    = $row[1];
                $c_quest_title  = mb_convert_encoding($row[2], 'UTF-8', 'SJIS');
                $c_quest_label1  = mb_convert_encoding($row[3], 'UTF-8', 'SJIS');
                $c_quest_value1  = 1;
                $c_quest_label2  = mb_convert_encoding($row[4], 'UTF-8', 'SJIS');
                $c_quest_value2  = 2;
                $c_quest_label3  = mb_convert_encoding($row[5], 'UTF-8', 'SJIS');
                $c_quest_value3  = 3;
                $c_quest_label4  = mb_convert_encoding($row[6], 'UTF-8', 'SJIS');
                $c_quest_value4  = 4;
                $c_quest_label5  = mb_convert_encoding($row[7], 'UTF-8', 'SJIS');
                $c_quest_value5  = 5;
                $c_quest_label6  = mb_convert_encoding($row[8], 'UTF-8', 'SJIS');
                $c_quest_value6  = 6;
                $c_quest_label7  = mb_convert_encoding($row[9], 'UTF-8', 'SJIS');
                $c_quest_value7  = 7;
                $c_quest_label8  = mb_convert_encoding($row[10], 'UTF-8', 'SJIS');
                $c_quest_value8  = 8;
                $c_quest_label9  = mb_convert_encoding($row[11], 'UTF-8', 'SJIS');
                $c_quest_value9  = 9;
                $c_quest_label10 = mb_convert_encoding($row[12], 'UTF-8', 'SJIS');
                $c_quest_value10 = 10;
                $c_quest_label11 = mb_convert_encoding($row[13], 'UTF-8', 'SJIS');
                $c_quest_value11 = 11;
                $c_quest_label12 = mb_convert_encoding($row[14], 'UTF-8', 'SJIS');
                $c_quest_value12 = 12;
            
                $csvimport_array = [
                    'i_question_id'   => $request->question_id,
                    'i_quest_no'      => $i_quest_no,
                    'c_quest_type'    => $c_quest_type,
                    'c_quest_title'   => $c_quest_title,
                    'c_quest_label1'  => $c_quest_label1,
                    'c_quest_value1'  => $c_quest_value1,
                    'c_quest_label2'  => $c_quest_label2,
                    'c_quest_value2'  => $c_quest_value2,
                    'c_quest_label3'  => $c_quest_label3,
                    'c_quest_value3'  => $c_quest_value3,
                    'c_quest_label4'  => $c_quest_label4,
                    'c_quest_value4'  => $c_quest_value4,
                    'c_quest_label5'  => $c_quest_label5,
                    'c_quest_value5'  => $c_quest_value5,
                    'c_quest_label6'  => $c_quest_label6,
                    'c_quest_value6'  => $c_quest_value6,
                    'c_quest_label7'  => $c_quest_label7,
                    'c_quest_value7'  => $c_quest_value7,
                    'c_quest_label8'  => $c_quest_label8,
                    'c_quest_value8'  => $c_quest_value8,
                    'c_quest_label9'  => $c_quest_label9,
                    'c_quest_value9'  => $c_quest_value9,
                    'c_quest_label10' => $c_quest_label10,
                    'c_quest_value10' => $c_quest_value10,
                    'c_quest_label11' => $c_quest_label11,
                    'c_quest_value11' => $c_quest_value11,
                    'c_quest_label12' => $c_quest_label12,
                    'c_quest_value12' => $c_quest_value12
                ];
                // つくった配列の箱($array)に追加
                array_push($array, $csvimport_array);
            }
            $row_count++;
        }
        //追加した配列の数を数える
        $array_count = count($array);
     
        //もし配列の数が500未満なら
        if ($array_count < 500){
//var_dump($array);
            //配列をまるっとインポート(バルクインサート)
            Question_list::insert($array);
        } else {
            //追加した配列が500以上なら、array_chunkで500ずつ分割する
            $array_partial = array_chunk($array, 500); //配列分割
       
            //分割した数を数えて
            $array_partial_count = count($array_partial); //配列の数
     
            //分割した数の分だけインポートを繰り替えす
            for ($i = 0; $i <= $array_partial_count - 1; $i++){
                Question_list::insert($array_partial[$i]);
            }
        }
        return back();
    }else{
        return back()->with('error', '0');
    }
}
}