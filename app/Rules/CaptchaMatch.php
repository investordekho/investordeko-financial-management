<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CaptchaMatch implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Retrieve the expected CAPTCHA value from the session.
        // Ensure that your CAPTCHA generation code stores the text with the key 'captcha_text'
        $expectedCaptcha = session('captcha_text');

        if ($value !== $expectedCaptcha) {
            $fail('The CAPTCHA is incorrect.');
        }
    }
}
