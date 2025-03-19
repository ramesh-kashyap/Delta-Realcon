<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fundtransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'transfer_id', 'transfered_id', 'user_id_from','amount','user_id_to','transfer_date'
    ];

      public function user()
    {
        return $this->belongsTo('App\User', 'transfer_id');
    } 
    
}
