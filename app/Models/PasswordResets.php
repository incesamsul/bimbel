<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    use HasFactory;
    protected $guarded = [''];

    protected $table = 'password_reset_tokens';
    public $timestamps = false;
}
