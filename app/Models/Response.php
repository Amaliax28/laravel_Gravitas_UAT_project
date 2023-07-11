<?php

namespace App\Models;

use App\Models\User;
use App\Models\Session;
use App\Models\TestCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Response extends Model
{
    use HasFactory;
    protected $fillable = ['session_id','test_cases_id','user_id','responseText','mobile','desktop','status','feedbackFile','feedbackImg','priorities','responseTime'];

    // Relationship with session
    public function session(){
        return $this->belongsTo(Session::class,'session_id');
    }

    // Relationship with TestCases
    public function testcase(){
        return $this->belongsTo(TestCase::class,'test_cases_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}



