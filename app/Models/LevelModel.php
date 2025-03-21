<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LevelModel extends Model
{
    use HasFactory;
    protected $table = 'm_level'; // nama table
    protected $primaryKey = 'level_id'; // primary key pada table tsb
    protected $fillable = ['level_kode', 'level_nama'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class);
    }
}
