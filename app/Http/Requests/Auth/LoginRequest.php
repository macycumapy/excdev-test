<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read string $email
 * @property-read string $password
 */
class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => ['email', 'required'],
            'password' => ['string', 'required'],
        ];
    }
}
