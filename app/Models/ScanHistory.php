<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ScanHistory
 *
 * @property int $id
 * @property string $website_id
 * @property int $status_code
 * @property int $response_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ScanHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScanHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ScanHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|ScanHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScanHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScanHistory whereResponseTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScanHistory whereStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScanHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ScanHistory whereWebsiteId($value)
 * @mixin \Eloquent
 */
class ScanHistory extends Model
{
    protected $fillable = [
        'website_id',
        'status_code',
        'response_time',
    ];
}
