<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property int $page
 * @property string $field
 * @property string $dir
 *
 * Class GetAdvertsRequest
 * @package App\Http\Requests
 */
class GetAdvertsRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'page' => [
                'nullable',
                'integer',
                'min:1',
            ],

            'field' => [
                'required_with:dir',
                Rule::in(['price', 'created_at']),
            ],

            'dir' => [
                'nullable',
                Rule::in(['asc', 'desc']),
            ],
        ];
    }
}
