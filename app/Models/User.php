<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 
        'email', 
        'phone_no',
        'username',
        'password'
      
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function categories_created(){
        return $this->hasMany(Category::class,'created_by','id');
    }

    public function user_projects(){
        return $this->hasMany(UserProject::class);
    }

    public function getUserDDL(){
        return User::select('id','name', 'username')->get();
    }

    public function projects(){
        return $this->belongsToMany(Project::class, 'user_project','user_id','project_id');
    }
 
}
