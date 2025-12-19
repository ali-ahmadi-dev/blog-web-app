<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class GoogleRecaptchaV3 implements ValidationRule
{


    public function __construct(private ?string $action = null, private ?float $minScore = null){

    }


    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */


    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //

        $sitVerify = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.googel_recaptcha_v3.sitekey'),
            'response' => $value,

        ]);
//        dd($sitVerify);

    }
}
