<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'status',
        'category_id',
        'genre_id',
        'country_id',
        'image'
    ];
    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function country(){
        return $this->belongsTo(Country::class,'country_id','id');
    }
    public function genre(){
        return $this->belongsTo(Genre::class,'genre_id','id');
    }
}
