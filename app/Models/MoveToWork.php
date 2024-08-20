<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MoveToWork extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'move_to_works';

    protected $fillable = [];

    public function coordinators(): HasMany
    {
        return $this->hasMany(Coordinator::class);
    }
}
