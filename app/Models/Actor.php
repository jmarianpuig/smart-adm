<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use App\Traits\AttributeHelpersTrait;
use Illuminate\Support\Str;

class Actor extends Model
{
    use HasFactory, AttributeHelpersTrait;

    protected $connection = 'mysql2';
    protected $table = 'actors';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        // Evento "saving" para generar y asignar el valor del "slug" antes de guardar el modelo
        static::saving(function ($actor) {

            if (!empty($actor->name) && !empty($actor->first_lname)) {
                // Generar el slug utilizando 'nombre' y 'apellido1', y 'apellido2' si está presente
                $slugValue = Str::slug($actor->name . '-' . $actor->first_lname . (!empty($actor->second_lname) ? '-' . $actor->second_lname : ''));
                $actor->createSlug($slugValue);
            }
        });
    }

    private function createSlug($slugValue)
    {
        // Verificar si el slug ya existe en la base de datos, excluyendo el actual modelo
        $count = 1;
        $originalSlug = $slugValue;
        $slugExists = static::where('slug', $slugValue)->where('id', '!=', $this->id)->exists();
        while ($slugExists) {
            $slugValue = $originalSlug . '-' . $count;
            $count++;
            $slugExists = static::where('slug', $slugValue)->where('id', '!=', $this->id)->exists();
        }

        // Asignar el slug único al modelo
        $this->slug = $slugValue;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(WebUser::class);
    }

    public function pant_size(): BelongsTo
    {
        return $this->belongsTo(PantSize::class);
    }

    public function shirt_size(): BelongsTo
    {
        return $this->belongsTo(ShirtSize::class);
    }

    public function shoe_size(): BelongsTo
    {
        return $this->belongsTo(ShoeSize::class);
    }

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(Municipio::class);
    }

    public function availability(): BelongsTo
    {
        return $this->belongsTo(Availability::class);
    }

    public function eye_color(): BelongsTo
    {
        return $this->belongsTo(EyeColor::class);
    }

    public function hair_color(): BelongsTo
    {
        return $this->belongsTo(HairColor::class);
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function study(): BelongsTo
    {
        return $this->belongsTo(Study::class);
    }

    public function imageables(): MorphMany
    {
        return $this->morphMany(Imageable::class, 'imageable');
    }

    public function avatar(): HasOne
    {
        return $this->hasOne(Imageable::class, 'imageable_id')->where('is_avatar', true);
    }

    // Método para eliminar el actor sin borrar imágenes ni relaciones al cambiar al modelo actor
    public function deleteActor()
    {
        parent::delete();
    }
}
