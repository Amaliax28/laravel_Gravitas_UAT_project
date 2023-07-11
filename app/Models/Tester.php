<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tester extends Model
{
    use HasFactory;
    protected $fillable = ['projects_id','user_id'];


    public function scopeFilter($query,array $filters ){


    }



    // Relationship to Project
    // Each tester can belong to one project
    public function project(){
        return $this->belongsTo(Project::class,'projects_id');
    }

}


