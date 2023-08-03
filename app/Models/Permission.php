<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
      /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['component_id', 'is_created', 'is_updated', 'is_deleted'];    // Other model configurations..
}
