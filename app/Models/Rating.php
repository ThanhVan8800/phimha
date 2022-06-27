<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'ratings';
    protected $fillable = [
        'episode_id',
        'user_id',
        'rating_star'
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function episode()
    {
        return $this->belongsTo(Episode::class,'episode_id');
    }
    //đảo 1 tập 1 người dc 1 lần
}
