<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'location'
      
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'spends');
    }
    public function project_users(){
        $this->hasMany(UserProject::class);
    }

    public function getProjectsDDL(){
        return Project::select('id','name')->get();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_project', 'project_id', 'user_id');
    }

    public function getAllProjectsByUser($user_id){
        return Project::where('project_users.user_id', $user_id)->get();
    }

    // public function users(){
    //     return $this->hasMany(User::class, 'user_project','user_id','project_id');
    // }

    
}
