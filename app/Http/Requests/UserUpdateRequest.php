<?php

namespace App\Http\Requests;

use App\Traits\GeneralFuncions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class UserUpdateRequest extends FormRequest
{
    use GeneralFuncions;

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
     * @return array
     */
    public function rules()
    {
        return [
            'User' => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'name' => [
                'nullable',
                'string'
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('users')->ignore($this->User, 'id')
            ],
            'password' => [
                'nullable',
                'string'
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'User' => $this->route()->parameter('User')
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            $this->getApiReturn(false, null, $validator->errors())
            , Response::HTTP_BAD_REQUEST));
    }
}
