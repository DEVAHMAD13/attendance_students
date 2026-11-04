<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $fillable = ['student_code','full_name','card_uid'];
     function attendance(){
        return $this->hasMany(attendance::class,'student_id');
    }
}
