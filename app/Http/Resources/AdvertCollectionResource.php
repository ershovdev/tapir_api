<?php

namespace App\Http\Resources;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Ramsey\Collection\Collection;

/**
 * @property string $title
 * @property Collection|Image $images
 * @property int $price
 *
 * Class Advert
 * @package App\Http\Resources
 */
class AdvertCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $adverts = $this->collection;

        return [
            'data' => $adverts,
        ];
    }
}
