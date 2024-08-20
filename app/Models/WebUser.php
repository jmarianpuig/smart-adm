<?php

namespace App\Models;

use App\Traits\AttributeHelpersTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WebUser extends Model
{
    use HasFactory, AttributeHelpersTrait;

    protected $connection = 'mysql2';
    protected $table = 'users';

    protected $guarded = [];

    public function xtra(): HasOne
    {
        return $this->hasOne(Xtra::class);
    }

    public function actor(): HasOne
    {
        return $this->hasOne(Actor::class);
    }

    public function parents(): HasOne
    {
        return $this->hasOne(ParentDetail::class, 'user_id');
    }

    public function coordinator(): HasOne
    {
        return $this->hasOne(Coordinator::class);
    }

}
