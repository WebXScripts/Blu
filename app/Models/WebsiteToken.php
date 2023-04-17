<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteToken extends Model
{
    public $fillable = [
        'website_id',
        'token',
        'has_been_viewed',
        'viewed_at',
    ];

    public $hidden = [
        'token'
    ];
}
