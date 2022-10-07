<?php

namespace App\Http\Requests;

use App\Exceptions\FormValidationException;
use App\Exceptions\Auth\UserNotAuthorizedException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string'
        ];
    }

    protected function failedAuthorization()
    {
        throw new UserNotAuthorizedException();
    }

    protected function failedValidation(Validator $validator)
    {
        throw new FormValidationException($validator);
    }
}
