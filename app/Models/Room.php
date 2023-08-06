<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

      /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['title', 'office_id', 'is_lab', 'is_Ac', 'is_updated', 'is_deleted']; 
}
