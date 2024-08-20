<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fileable extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'fileables';

    protected $fillable = ['url'];

    public function fileable()
    {
        return $this->morphTo();
    }
}
