<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
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
            'title' => ['required', 'string', 'unique:App\Models\Role'],
            'permissions' => ['nullable', 'array'],
            'permissions.*.module_id' => ['nullable', 'required_with:permissions', 'numeric', 'integer', 'exists:App\Models\Module,id'],
            'permissions.*.can_view' => ['nullable', 'required_with:permissions', 'numeric', 'integer', 'digits:1', 'in:0,1'],
            'permissions.*.can_create' => ['nullable', 'required_with:permissions', 'numeric', 'integer', 'digits:1', 'in:0,1'],
            'permissions.*.can_edit' => ['nullable', 'required_with:permissions', 'numeric', 'integer', 'digits:1', 'in:0,1'],
            'permissions.*.can_delete' => ['nullable', 'required_with:permissions', 'numeric', 'integer', 'digits:1', 'in:0,1'],
        ];
    }
}
