<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ca extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'provincias';

    public function provincias(): HasMany
    {
        return $this->hasMany(Provincia::class);
    }
}
