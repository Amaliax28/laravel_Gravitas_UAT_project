<?php

namespace App\Models;

use App\Models\Project;
use App\Models\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Session extends Model
{
    use HasFactory;
    protected $fillable = ['projects_id','sessionName','sessionStartDate','sessionDesc','status','sessionTime'];

    public function scopeFilter($query, array $filters) {
        // For Search Sessions
         if($filters['search'] ?? false){
            $query->where('sessionName','like','%'.request('search').'%')
                  ->orWhere('sessionStartDate','like','%'.request('search').'%')
                  ->orWhere('sessionDesc','like','%'.request('search').'%')
                  ->orWhere('status','like','%'.request('search').'%');
        }
    }


    // Relationship with project
    // One Session Can Belong to One Project
    public function project(){
        return $this->belongsTo(Project::class,'projects_id');
    }

    // Relationship with TestCase
    // One Session can create many testcases
    public function testcase(){
        return $this->hasMany(TestCase::class,'session_id');
    }

    // Relationship with Responses
    public function response(){
        return $this->hasMany(Response::class,'session_id');
    }

}
