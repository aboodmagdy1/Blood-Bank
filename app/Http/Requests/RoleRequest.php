<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        if($this->routeIs('roles.update'))
        {
            $id = $this->role;
            return [
            'name' => 'required|string|unique:roles,name,' . $id,
            'permissions_list' => 'required|array'
            ];
        }
        return [
         'name' => 'required|string|unique:roles,name',
            'permissions_list' => 'required|array'
        ];
    }
    public function messages(){
         [
            'name.required' => 'اسم الرتبه مطلوب',
            'name.unique' => 'هذا الاسم موجود بالفعل',
            'permissions_list.required' => 'الصلاحيات مطلوبه',

         ];
    }
}
