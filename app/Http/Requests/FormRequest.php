<?php

namespace App\Http\Requests;

use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest as FormRequestLaravel;

abstract class FormRequest extends FormRequestLaravel
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function authorize();

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * Handle a failed event
     * Override default laravel behaviour 
     */
    protected function failedValidation(Validator $validator) 
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(response()->json(
            compact('errors'),
            JsonResponse::HTTP_UNPROCESSABLE_ENTITY
        ));     
    }
}
