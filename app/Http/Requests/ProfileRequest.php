<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'confirmed',
            'email' => Rule::unique('clients', 'email')->ignore($this->user()->id),
            'phone' => Rule::unique('clients', 'phone')->ignore($this->user()->id),
            'governorate_id' => 'exists:governorates,id',
            'blood_type_id' => 'exists:blood_types,id',
            'city_id' => 'exists:cities,id',
        ];
    }
}
