<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShirtSize extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'shirt_sizes';

    public function xtras(): HasMany
    {
        return $this->hasMany(Xtra::class);
    }

    public function actors(): HasMany
    {
        return $this->hasMany(Actor::class);
    }
}
