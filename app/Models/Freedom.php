<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freedom extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'status', 'lecture_id' , 'user_id','room_id', 'class_id', 'subject_id', 'day_id', 'timing_id'];
}
