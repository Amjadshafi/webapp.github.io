<?php

namespace App\Models;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spend extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id', 
        'title', 
        'totalAmount',
        'status',
        'created_by',
        'category_id'
      
    ];


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'created_by','id');
    }

    public function spend_files(){
        return $this->hasMany(SpendFile::class);
    }

    public function filterData($request){
        $dates = explode(' - ',$request['dateRange']);
        $startOfDay = Carbon::parse($dates[0])->startOfDay();
        $endOfDay = Carbon::parse($dates[1])->endOfDay();
        $obj = Spend::where('created_at', '>=',$startOfDay)
                    ->where('created_at', '<=' ,$endOfDay);
        if(!empty($request['project_id'])){
            $obj->where('project_id',$request['project_id']);
        }
        if(!empty($request['category_id'])){
            $obj->where('category_id',$request['category_id']);
        }
        $obj->with(['category', 'project', 'user','spend_files']);
        return $obj->get();
    }
    
}
