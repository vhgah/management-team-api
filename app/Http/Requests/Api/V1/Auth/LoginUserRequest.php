<?php

namespace App\Http\Requests\Api\V1\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;

class LoginUserRequest extends FormRequest
{
    /** 
     * Max attempts count per minute for the request with invalid credentials. *
     */
    protected const MAX_ATTEMPTS = 5;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'         => ['required', 'email'],
            'password'      => ['required', 'string'],
            'device_name'   => ['required', 'string']
        ];
    }

    public function HitAttempt()
    {
        RateLimiter::hit($this->throttleKey());
    }

    public function throttleKey()
    {
        return Str::transliterate(Str::lower($this->input('email') . '|' . $this->ip()));
    }
}
