<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * App\Models\Image
 *
 * @property int $id
 * @property int $advert_id
 * @property string $url
 * @property string $path
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Advert $advert
 * @method static Builder|Image newModelQuery()
 * @method static Builder|Image newQuery()
 * @method static Builder|Image query()
 * @method static Builder|Image whereAdvertId($value)
 * @method static Builder|Image whereCreatedAt($value)
 * @method static Builder|Image whereId($value)
 * @method static Builder|Image whereUrl($value)
 * @method static Builder|Image wherePath($value)
 * @method static Builder|Image whereStatus($value)
 * @method static Builder|Image whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Image extends Model
{
    use HasFactory;

    public const PENDING_STATUS = 'pending';
    public const READY_STATUS   = 'ready';
    public const FAILED_STATUS  = 'failed';

    protected $fillable = [
        'advert_id', 'url', 'path', 'status',
    ];

    public function advert(): BelongsTo
    {
        return $this->belongsTo(Advert::class);
    }
}
