<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $guarded = ['id'];
    protected $fillable = [
        'i_question_id','i_taisyosha_id','i_quest_no','c_quest_value',
    ];
}
