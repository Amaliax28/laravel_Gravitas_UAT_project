<?php

namespace App\Models;

use App\Models\Session;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['projectName','projectDetails','status','projectImg','user_id','projectTime'];

    public function scopeFilter($query,array $filters ){

        // For search projects
        if($filters['search'] ?? false){
            $query->where('projectName','like','%'.request('search').'%')
                  ->orWhere('projectDetails','like','%'.request('search').'%')
                  ->orWhere('status','like','%'.request('search').'%');
        }

    }

    // Relationship to User
    // 1 project belongs to 1 User
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    // Relationship to Session
    // One project can have many sessions
    public function session(){
        return $this->hasMany(Session::class,'projects_id');
    }

    // Relationship to Projects
    public function tester(){
        return $this->hasMany(Tester::class,'projects_id');
    }




}
