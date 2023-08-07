<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

            /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['id','title', 'semester_no'];
}
