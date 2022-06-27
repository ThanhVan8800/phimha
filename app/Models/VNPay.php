<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VNPay extends Model
{
    use HasFactory;
    protected $table = 'v_n_pays';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
