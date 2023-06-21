<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Website
 *
 * @property string $id
 * @property string $name
 * @property string $url
 * @property string|null $description
 * @property string $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection<int, \Spatie\MediaLibrary\MediaCollections\Models\Media> $media
 * @property-read int|null $media_count
 * @property-read \App\Models\Parameter|null $parameters
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ScanHistory> $scanHistories
 * @property-read int|null $scan_histories_count
 * @method static \Illuminate\Database\Eloquent\Builder|Website newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Website newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Website query()
 * @method static \Illuminate\Database\Eloquent\Builder|Website whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Website whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Website whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Website whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Website whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Website whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Website whereUserId($value)
 * @mixin \Eloquent
 */
class Website extends Model implements HasMedia
{
    use InteractsWithMedia, HasUuids;

    protected $fillable = [
        'name',
        'url',
        'description',
        'user_id',
    ];

    public function parameters(): HasOne
    {
        return $this->hasOne(Parameter::class);
    }

    public function scanHistories(): HasMany
    {
        return $this->hasMany(ScanHistory::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnail')
            ->singleFile();
    }

    public function hasThumbnail(): bool
    {
        return $this->getFirstMedia('thumbnail') !== null;
    }

    public function getThumbnailUrl(): string
    {
        return $this->getFirstMediaUrl('thumbnail');
    }
}
