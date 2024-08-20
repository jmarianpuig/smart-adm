<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Viewer extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table = 'viewers';
    protected $guarded = [];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class)->withPivot('is_selected');
    }

    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class);
    }

    public function getFormattedNameAttribute()
    {
        return ucwords(mb_strtolower($this->attributes['name']));
    }

    // mutator para formatear el telefono
    public function getFormattedPhoneAttribute()
    {
        return substr($this->phone, 0, 3) . ' ' . substr($this->phone, 3, 3) . ' ' . substr($this->phone, 6, 3);
    }

    // mutador para la provincia
    public function getFormattedProvinciaIdAttribute()
    {
        return Provincia::where('id', $this->provincia_id)->value('provincia');
    }
}
