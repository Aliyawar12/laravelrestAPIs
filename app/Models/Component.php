<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;
        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['id','name'];
        

        public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
    
}
