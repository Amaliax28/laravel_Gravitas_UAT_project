<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Response;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'roles',
        'userImage'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Search testers
    public function scopeFilter($query, array $filters) {
        // For Search Sessions
         if($filters['search'] ?? false){
            $query->where('username','like','%'.request('search').'%');
                  //->orWhere('sessionStartDate','like','%'.request('search').'%')
                  //->orWhere('sessionDesc','like','%'.request('search').'%')
                  //->orWhere('status','like','%'.request('search').'%');
        }
    }

    // Relationship with projects
    // Each user can have many projects
    public function projects(){
        return $this->hasMany(Project::class,'user_id');
    }

    // Relationship with table Roles
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    // Relationship with testcases
    public function testcase(){
        return $this->hasMany(TestCase::class,'session_id');
    }

    // Relationship with responses
    public function response(){
        return $this->hasMany(Response::class,'user_id');
    }


}
