<?php

namespace App\Models;

use App\Models\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestCase extends Model
{
    use HasFactory;
    protected $fillable = ['testCaseImage','testCaseText','session_id','user_id','testCaseTime'];

    // Relationship with Session
    // One Test Case belongs to One Session
    public function session(){
        return $this->belongsTo(Session::class,'session_id');
    }

    // Relationship with user
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    // Relationship with Response
    public function response(){
        return $this->hasMany(Response::class,'test_cases_id');
    }


}
