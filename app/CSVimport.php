<?php
 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Csvimport extends Model
{
    protected $fillable = ['name','reserved_date','checkin_date','total_price'];
}