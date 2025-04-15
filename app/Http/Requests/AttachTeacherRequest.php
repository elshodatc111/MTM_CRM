<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachTeacherRequest extends FormRequest{
    public function authorize(): bool{
        return true; 
    }

    public function rules(): array{
        return [
            'guruh_id' => 'required|exists:guruhs,id',
            'user_id' => 'required|exists:users,id',
            'start_description' => 'required|string|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'guruh_id.required' => 'Guruh tanlanmagan.',
            'user_id.required' => 'Tarbiyachi tanlanmagan.',
            'start_description.required' => 'Izoh yozilishi shart.',
        ];
    }
}
