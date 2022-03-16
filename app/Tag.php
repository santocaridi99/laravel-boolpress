<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //relazione molti a molti con i post 
    public function posts(){
        return $this->belongsToMany("App\Post");
    }
}
