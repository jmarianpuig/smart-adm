<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Municipio extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'municipios';

    public function xtras(): HasMany
    {
        return $this->hasMany(Xtra::class);
    }

    public function actors(): HasMany
    {
        return $this->hasMany(Actor::class);
    }

    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class);
    }
}
