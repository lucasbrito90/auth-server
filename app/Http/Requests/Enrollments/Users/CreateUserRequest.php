<?php

namespace App\Http\Requests\Enrollments\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class CreateUserRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;
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
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'date_of_birth' => ['nullable', 'date'],
            'phone_number' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string'],
            'country' => ['nullable', 'string'],
            'state_province' => ['nullable', 'string'],
            'postal_code' => ['nullable', 'string'],
            'sector' => ['nullable', 'string'],
            'role' => ['nullable', 'required', 'string'],
            'permissions' => ['nullable', 'array'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name',
            'email' => 'Email Address',
            'date_of_birth' => 'Date of Birth',
            'phone_number' => 'Phone Number',
            'address' => 'Address',
            'city' => 'City',
            'country' => 'Country',
            'state_province' => 'State/Province',
            'postal_code' => 'Postal Code',
            'sector' => 'Sector',
            'role' => 'Role',
            'permissions' => 'Permissions',
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'password' => Hash::make($this->get('email')),
        ]);
    }
}
