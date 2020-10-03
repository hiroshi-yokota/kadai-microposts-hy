<?php

use Illuminate\Database\Seeder;

class taisyosya_listsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 100; $i++) {
            DB::table('taisyosya_lists')->insert([
                'i_question_id' => '1',
                'i_taisyosha_id' => $i,
                'c_taisyosha_name_sei' => 'テスト（姓）' . $i,
                'c_taisyosha_name_mei' => 'テスト（名）' . $i,
                'e_mail' => 'yokoyokomin@gmail.com'
            ]);
        }
    }
}