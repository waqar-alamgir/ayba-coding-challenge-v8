<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/*
|--------------------------------------------------------------------------
| SelfMatrix
|--------------------------------------------------------------------------
|
| This rule validates matrix.
|
*/
class SelfMatrix implements Rule
{
    /**
     * @inheritdoc
     */
    public function passes($attribute, $value): bool
    {
        $total = count($value);
        $return = true;

        // If there is only one row no need to make check
        if ($total > 1) {
            // set a length value
            $firstLength = count($value[0]);
            for ($i = 0; $i < $total; $i++) {
                if (count($value[$i]) !== $firstLength) {
                    $return = false;
                    break;
                }
            }
        }
        return $return;
    }

    /**
     * @inheritdoc
     */
    public function message(): string
    {
        return ":attribute must not be empty or has differnt row's length.";
    }
}
