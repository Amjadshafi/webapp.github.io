<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpendFile extends Model
{
    // 

    public function spend(){
        return $this->belongsTo(Spend::class);
    }
}
