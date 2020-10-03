<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = [
        'i_question_id','c_question_name','c_question_ymd_start','c_question_ymd_end',
    ];
}