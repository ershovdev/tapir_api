<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

/**
 * App\Models\Advert
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $price
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Collection|Image $images
 * @method static Builder|Advert newModelQuery()
 * @method static Builder|Advert newQuery()
 * @method static Builder|Advert query()
 * @method static Builder|Advert whereCreatedAt($value)
 * @method static Builder|Advert whereDescription($value)
 * @method static Builder|Advert whereId($value)
 * @method static Builder|Advert wherePrice($value)
 * @method static Builder|Advert whereTitle($value)
 * @method static Builder|Advert whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Advert extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'price',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
