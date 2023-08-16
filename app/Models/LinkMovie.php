<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkMovie extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'linkmovie';
    protected $fillable =[
        'title', 'description', 'status'
    ];
}
