<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = ['id','user_id','room_id', 'class_id', 'subject_id', 'day_id', 'timing_id', 'is_cancelled', 'on_scheduled' ];
}
