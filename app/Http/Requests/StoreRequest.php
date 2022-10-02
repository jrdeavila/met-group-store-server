<?php

namespace App\Http\Requests;

use App\Exceptions\FormValidationException;
use App\Exceptions\UserNotAuthorizedException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                Rule::unique('stores', 'name')->ignore($this->id)
            ]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new FormValidationException($validator);
    }

    protected function failedAuthorization()
    {
        throw new UserNotAuthorizedException();
    }
}
