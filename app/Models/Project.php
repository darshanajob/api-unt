<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

        protected $fillable = [
        'project_id',
        'project_name',
        'project_description',
        
      
    ];

    public function images(){
        return $this->hasMany(\App\Models\images::class,'project_id');
      }

}
