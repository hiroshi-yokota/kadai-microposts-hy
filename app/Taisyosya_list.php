<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taisyosya_list extends Model
{
    //
    protected $fillable = [
        'i_question_id','i_taisyosha_id','c_taisyosha_name_sei','c_taisyosha_name_mei','e_mail',
    ];
}
