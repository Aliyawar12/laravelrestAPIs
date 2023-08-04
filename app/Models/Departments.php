<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    use HasFactory;
           /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['id','name','head_id', 'subdepartment_id'];
}
