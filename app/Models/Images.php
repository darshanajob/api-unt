<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    
    
    protected $table = 'images';
    protected $fillable = [
        'project_id',
        'url',
      
    ];

    public function user(){
        return $this->belongsTo(\App\Models\Project::class,'project_id');
      }

}
