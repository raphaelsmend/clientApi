<?php

namespace App\Http\Requests;

use App\Traits\GeneralFuncions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

class StoreClientRequest extends FormRequest
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
            'name' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'unique:clients,email',
                'email'
            ],
            'phone1' => [
                'required',
                'string'
            ],
            'phone2' => [
                'nullable',
                'string'
            ],
            'zipCode' => [
                'required',
                'integer'
            ],
            'address_number' => [
                'nullable',
                'string'
            ],
            'address_complement' => [
                'nullable',
                'string'
            ]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            $this->getApiReturn(false, null, $validator->errors())
            , Response::HTTP_BAD_REQUEST));
    }
}
