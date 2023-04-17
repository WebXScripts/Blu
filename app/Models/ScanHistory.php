<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScanHistory extends Model
{
    protected $fillable = [
        'website_id',
        'status_code',
        'response_time',
    ];
}
