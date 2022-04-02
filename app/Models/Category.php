<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    use HasFactory;
    // 1 danh mục thì có nhiều phim
    public function movie(){
        return $this->hasMany(Movie::class)->orderBy('id','desc');
        
        // lấy phim mới nhất load lên cate_home
    }
}
