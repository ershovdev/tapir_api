<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ImageLinksRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        foreach ($value as $url) {
            $valid = filter_var($url, FILTER_VALIDATE_URL);

            if (!$valid) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid URL in images array';
    }
}
