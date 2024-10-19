<?php

namespace App\Http\Requests;

use App\Models\Client;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "name" => ['required', 'string'],
            "email" => ['required', 'string', 'email', 'unique:clients,email'],
            "password" => ['required', 'string', 'confirmed'],
            "phone" => ['required', 'string', 'unique:clients,phone'],
            "d_o_b" => ['required', 'date'],
            "city_id" => ['required', 'integer', 'exists:cities,id'],
            "blood_type_id" => ['required', 'integer', 'exists:blood_types,id'],
            "governorate_id" => ['required', 'integer', 'exists:governorates,id'],
            "last_donation_date" => ['required', 'date']
        ];
    }
}
