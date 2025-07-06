<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', 'integer', 'digits:1', 'in:0,1'],
            'first_name' => ['required', 'string', 'max:128'],
            'last_name' => ['required', 'string', 'max:128'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:App\Models\User'],
            'password' => [
                            'required', 
                            Password::min(8)->letters()->mixedCase()->numbers()
                        ],
            'contact_no' => ['nullable', 'numeric', 'digits_between:10,16'],
            'sec_contact_no' => ['nullable', 'numeric', 'digits_between:10,16'],
            'user_type_id' => ['required', 'numeric', 'integer', 'exists:App\Models\UserType,id'],
            'designation_id' => ['nullable', 'required_if:user_type_id,1', 'numeric', 'integer', 'exists:App\Models\Designation,id'],
            'user_image' => ['nullable', 'file', 'image', 'max:2048'],
            'user_role_ids' => ['nullable', 'array'],
            'user_role_ids.*' => ['nullable', 'required_with:user_role_ids', 'numeric', 'integer', 'exists:App\Models\Role,id']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'designation_id.required_if' => '"Designation" is required when "User Type" is "Staff"',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'user_type_id' => 'user type',
            'designation_id' => 'designation',
        ];
    }
}
