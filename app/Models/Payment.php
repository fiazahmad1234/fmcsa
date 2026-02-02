<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Payment extends Model
{
    protected $fillable = [
        'payment_id', 'name', 'email', 'phone', 'address', 'amount', 'currency', 'status'
    ];
}

