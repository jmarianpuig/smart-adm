<?php

namespace App\Models;

use App\Traits\AttributeHelpersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;

class Coordinator extends Model
{
    use HasFactory, AttributeHelpersTrait;

    protected $connection = 'mysql2';
    protected $table = 'coordinators';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        // Evento "saving" para generar y asignar el valor del "slug" antes de guardar el modelo
        static::saving(function ($coordinator) {

            if (!empty($coordinator->name) && !empty($coordinator->first_lname)) {
                // Generar el slug utilizando 'nombre' y 'apellido1', y 'apellido2' si está presente
                $slugValue = Str::slug($coordinator->name . '-' . $coordinator->first_lname . (!empty($coordinator->second_lname) ? '-' . $coordinator->second_lname : ''));
                $coordinator->createSlug($slugValue);
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

    // Eliminar imágenes de avatar y normales y archivo asociadas antes de borrar el coordinador
    public function delete()
    {
        foreach ($this->imageables as $imageable) {
            $imageable->deleteImage();
        }

        $this->fileables->deleteFile();

        parent::delete();
    }

    // relaciones
    public function user(): BelongsTo
    {
        return $this->belongsTo(WebUser::class);
    }

    public function municipio(): BelongsTo
    {
        return $this->belongsTo(Municipio::class);
    }

    public function move_to_work(): BelongsTo
    {
        return $this->belongsTo(MoveToWork::class);
    }

    public function imageables(): MorphMany
    {
        return $this->morphMany(Imageable::class, 'imageable');
    }

    public function avatar(): MorphOne
    {
        return $this->morphOne(Imageable::class, 'imageable_id')->where('is_avatar', true);
    }

    public function fileables(): MorphOne
    {
        return $this->morphOne(Fileable::class, 'fileable');
    }
}
