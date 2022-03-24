<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    // implemento uso dei soft Deletes nei post
    use SoftDeletes;
    protected $fillable = ["title", "content", "slug","category_id"];
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
