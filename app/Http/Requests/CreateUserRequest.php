<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'email_verified_at' => 'nullable|date_format:Y-m-d\TH:i',
            'phone_number' => 'nullable|string|min:5|max:20',
            'subscription_end_date' => 'nullable|date_format:Y-m-d\TH:i',
            'avatar' => 'nullable|image|max:2048',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'boolean',
        ];
    }
}
