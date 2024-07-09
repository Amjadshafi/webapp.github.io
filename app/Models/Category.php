<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 
        'created_by'      
    ];

    public function user(){
        return $this->belongsTo(User::class,'created_by','id');
    }


    public function getcategoryDDL(){
        return Category::select('id','title')->get();
    }
}
