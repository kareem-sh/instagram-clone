<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Gate::allows('edit-update-profile',$this->user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required',Rule::unique('users')->ignore($this->user())],
            'bio' => 'nullable',
            'image' => 'image',
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email,' . $this->user()->id],
            'current-password' => ['required_with:password', 'nullable', function ($attribute, $value, $fail) {
                if (!Hash::check($value, $this->user()->password)) {
                    $fail('The current password is incorrect.');
                }
            }],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'lang'=>'required'
        ];
    }
}
