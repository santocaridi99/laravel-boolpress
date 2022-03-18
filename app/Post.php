<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["title", "content", "slug","category_id","image"];
    // tanti Post corrispondono a 1 User
    public function user(){
        return $this->belongsTo("App\User");
    }
    // tanti post corrispondono ad una categoria
    public function category(){
        return $this->belongsTo("App\Category");
    }
    // relazione molti a molti tra post e tag
    public function tags(){
        return $this->belongsToMany("App\Tag");
    }
}
