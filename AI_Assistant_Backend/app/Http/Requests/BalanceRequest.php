<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BalanceRequest extends FormRequest
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
            'user_id' => ['required', 'uuid'],
            'income_id' => ['required', 'uuid'],
            'expense_id' => ['required', 'uuid'],
            'balance' => ['required', 'numeric'],
            'active' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'User ID is required.',
            'user_id.uuid' => 'User ID must be a valid UUID.',
            'income_id.required' => 'Income ID is required.',
            'income_id.uuid' => 'Income ID must be a valid UUID.',
            'expense_id.required' => 'Expense ID is required.',
            'expense_id.uuid' => 'Expense ID must be a valid UUID.',
            'balance.required' => 'Balance is required.',
            'balance.numeric' => 'Balance must be a number.',
            'active.required' => 'Active is required.',
            'active.boolean' => 'Active must be 0 or 1',

        ];
    }
}
