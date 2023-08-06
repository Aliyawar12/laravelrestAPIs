<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdepartment extends Model
{
    use HasFactory;

       /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['id','name', 'department_id', "head_id"];
}
