<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDailyFetch extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'mc_count', 'email_count', 'fetch_date'];
}
