<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class attendance extends Model
{
    protected $fillable = ['student_id','attendance_date','attendance_time','status','source'];
    function students(){
        return $this->belongsTo(student::class,'student_id');
    }
}
