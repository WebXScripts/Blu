<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Parameter
 *
 * @property int $id
 * @property string $website_id
 * @property int $scan_interval
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Parameter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Parameter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Parameter query()
 * @method static \Illuminate\Database\Eloquent\Builder|Parameter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parameter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parameter whereScanInterval($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parameter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Parameter whereWebsiteId($value)
 * @mixin \Eloquent
 */
class Parameter extends Model
{
    protected $fillable = [
        'website_id',
        'scan_interval',
    ];
}
