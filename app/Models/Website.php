<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Website extends Model
{
    protected $fillable = [
        'name',
        'url',
        'description',
        'user_id',
        'uuid',
    ];

    public function parameters(): HasOne
    {
        return $this->hasOne(Parameter::class);
    }

    public function scanHistories(): HasMany
    {
        return $this->hasMany(ScanHistory::class);
    }

    public function token(): HasOne
    {
        return $this->hasOne(WebsiteToken::class);
    }
}
