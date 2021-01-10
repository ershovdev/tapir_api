<?php

namespace App\Http\Requests;

use App\Rules\ImageLinksRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

/**
 * @property string $title
 * @property string $description
 * @property array $images
 *
 * Class StoreAdvertRequest
 * @package App\Http\Requests
 */
class StoreAdvertRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => ['required', 'string', 'max:200'],
            'description' => ['required', 'string', 'max:1000'],
            'price'       => ['required', 'integer'],
            'images'      => ['bail', 'required', 'array', 'min:1', 'max:3', new ImageLinksRule],
        ];
    }
}
