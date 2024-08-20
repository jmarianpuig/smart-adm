<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provincia extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'provincias';


    public function ca(): BelongsTo
    {
        return $this->belongsTo(Ca::class);

    }

    public function municipios(): HasMany
    {
        return $this->hasMany(Municipio::class);
    }
}
