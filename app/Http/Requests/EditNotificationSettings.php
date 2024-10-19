<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditNotificationSettings extends FormRequest
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
            'blood_types_id' => ['array'],
            'governorates_id' => ['array'],
            'blood_types_id.*' => 'exists:blood_types,id',
            'governorates_id.*' => 'exists:governorates,id',
        ];
    }
}
