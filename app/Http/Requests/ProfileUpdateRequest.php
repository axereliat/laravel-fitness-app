<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'height' => ['required', 'numeric', 'min:150', 'max:220'],
            'weight' => ['required', 'numeric', 'min:40', 'max:220'],
            'avatar' => ['nullable', 'image', 'max:1024', 'mimes:jpg,jpeg,png']
        ];
    }

    public function messages()
    {
        return [
            'avatar.max' => 'Avatar max file size is 1MB',
        ];
    }
}
