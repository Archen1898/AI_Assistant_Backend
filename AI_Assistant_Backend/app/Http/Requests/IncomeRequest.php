<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IncomeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
            'date' => ['required', 'date'],
            'amount' => ['required', 'numeric'],
            'recurring' => ['boolean'],
            'balance_id' => ['required', 'uuid'],
            //'category_id' => ['required', 'exists:categories,id'],
            'income_type_id' => ['required', 'uuid'],
            //'currency_id' => ['required', 'uuid'],

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name must not exceed 255 characters.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description must not exceed 255 characters.',
            'date.required' => 'The date field is required.',
            'amount.required' => 'The amount field is required.',
            'amount.numeric' => 'The amount must be a number.',
            'balance_id.required' => 'The balance field is required.',
            'balance_id.uuid' => 'The balance ID must be a valid UUID.',
            'income_type_id.required' => 'The income type field is required.',
            'income_type_id.uuid' => 'The income type ID must be a valid UUID.',
            'recurring.boolean' => 'The recurring field must be a boolean.',
        ];
    }
}
