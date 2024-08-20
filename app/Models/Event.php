<?php

namespace App\Models;

use App\Traits\AttributeHelpersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    use HasFactory, AttributeHelpersTrait;

    protected $connection = 'mysql2';
    protected $table = 'events';
    protected $guarded = [];

    public function viewers(): BelongsToMany
    {
        return $this->belongsToMany(Viewer::class)->withPivot('is_selected');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function provincia(): BelongsTo
    {
        return $this->belongsTo(Provincia::class);
    }

    public function getFormattedEventDateAttribute()
    {
        return date('d/m/Y H:i', strtotime($this->event_date));
    }
}
