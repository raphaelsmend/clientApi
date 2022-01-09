<?php

namespace App\Http\Requests;

use App\Traits\GeneralFuncions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class UpdateClientRequest extends FormRequest
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
            'Client' => [
                'required',
                'integer',
                'exists:clients,id'
            ],
            'name' => [
                'nullable',
                'string'
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('clients')->ignore($this->Client, 'id')
            ],
            'phone1' => [
                'nullable',
                'string'
            ],
            'phone2' => [
                'nullable',
                'string'
            ],
            'zipCode' => [
                'nullable',
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

    protected function prepareForValidation()
    {
        $this->merge([
            'Client' => $this->route()->parameter('Client')
        ]);
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            $this->getApiReturn(false, null, $validator->errors())
            , Response::HTTP_BAD_REQUEST));
    }
}
