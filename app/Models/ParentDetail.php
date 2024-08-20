<?php

namespace App\Models;

use App\Traits\AttributeHelpersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ParentDetail extends Model
{
    use HasFactory, AttributeHelpersTrait;

    protected $connection = 'mysql2';
    protected $table = 'parent_details';

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(WebUser::class, 'user_id');
    }
}
