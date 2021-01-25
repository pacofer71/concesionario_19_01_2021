<?php

namespace App\Rules;

use Hamcrest\Type\IsInteger;
use Illuminate\Contracts\Validation\Rule;

class KilometrosRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return ($value>=1500 && $value<=150000);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Kilometros erróneos !!!!';
    }
}
