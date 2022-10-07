<?php

namespace App\Http\Requests;

use App\Exceptions\FormValidationException;
use App\Exceptions\Auth\UserNotAuthorizedException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
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

        $toggle = $this->method() === 'POST';
        return [
            'name' => [
                'string',
                Rule::when($toggle, ['prohibited'])
            ],
            'price' => [
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/',
                Rule::when(
                    $toggle,
                    ['required'],
                ),
            ],
            'store_id' => [
                'numeric',
                Rule::when($toggle, ['required']),
                Rule::exists('stores', 'id')
            ]
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
