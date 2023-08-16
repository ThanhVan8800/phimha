<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Movie extends Model
{
    public $timestamps = false;
    use HasFactory;
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function genre(){
        return $this->belongsTo(Genre::class,'genre_id');
    }
    public function movie_genre(){
        return $this->belongsToMany(Genre::class,'movie_genres','movie_id','genre_id','id');
    }
    public function episode(){
        return $this->hasMany(Episode::class);
    }
    public function movie_category(){
        return $this->belongsToMany(Category::class,'movie_categories','movie_id','category_id','id');
    }
    //phim thuộc nhiều thể loại
}
