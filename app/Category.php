<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // una categoria corrisponde a tanti post
    public function posts(){
        return $this->hasMany("App\Post");
    }
}
