<?php

namespace App\Http\Resources;

use App\Models\Advert;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Advert $advert */
        $advert = $this->resource;

        return [
            'title' => $advert->title,
            'image' => isset($advert->images[0]) ? $advert->images[0]->url : null,
            'price' => $advert->price,
        ];
    }
}
