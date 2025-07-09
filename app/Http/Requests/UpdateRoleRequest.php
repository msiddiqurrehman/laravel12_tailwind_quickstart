<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\Role;
use Illuminate\Validation\Rule;

class UpdateRoleRequest extends FormRequest
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
            'title' => ['required', 'string', Rule::unique(Role::class)->ignore($this->role->id)],
            'permissions' => ['nullable', 'array'],
            'permissions.*.id' => ['nullable', 'numeric', 'integer', 'exists:App\Models\Permission'],
            'permissions.*.module_id' => ['nullable', 'required_with:permissions', 'numeric', 'integer', 'exists:App\Models\Module,id'],
            'permissions.*.created_by' => ['nullable', 'numeric', 'integer', 'exists:App\Models\User,id'],
            'permissions.*.can_view' => ['nullable', 'required_with:permissions', 'numeric', 'integer', 'digits:1', 'in:0,1'],
            'permissions.*.can_create' => ['nullable', 'required_with:permissions', 'numeric', 'integer', 'digits:1', 'in:0,1'],
            'permissions.*.can_edit' => ['nullable', 'required_with:permissions', 'numeric', 'integer', 'digits:1', 'in:0,1'],
            'permissions.*.can_delete' => ['nullable', 'required_with:permissions', 'numeric', 'integer', 'digits:1', 'in:0,1'],
        ];
    }
}
