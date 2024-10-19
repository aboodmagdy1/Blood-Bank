<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DonationRequestRequest extends FormRequest
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
            'patient_name' => 'required|string',
            'patient_age' => 'required|integer',
            'patient_phone' => 'required|string',
            'blood_type_id' => 'required|exists:blood_types,id',
            'bags_num' => 'required|integer',
            'hospital_name' => 'required|string',
            'hospital_address' => 'required|string',
            'city_id' => 'required|exists:cities,id',
            'details' => 'nullable|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
        ];
    }
}
