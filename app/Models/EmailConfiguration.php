<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailConfiguration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'password',
        'smtp_host',
        'smtp_port',
        'smtp_encryption',
    ];

    // Relation to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
