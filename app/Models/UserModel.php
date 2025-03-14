<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'm_user'; // nama table
    protected $primaryKey = 'user_id'; // primary key pada table tsb

    protected $fillable = [
        'level_id',
        'username',
        'nama',
    ];
}
