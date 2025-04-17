<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveKindergartenRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'id' => ['required', 'exists:children,id'],
            'end_description' => ['required', 'string', 'min:3'],
        ];
    }

    public function messages(): array{
        return [
            'id.required' => 'Bola ID topilmadi.',
            'id.exists' => 'Bunday bola mavjud emas.',
            'end_description.required' => 'Tark etish sababi majburiy.',
            'end_description.min' => 'Sabab kamida 3 ta belgidan iborat bo‘lishi kerak.',
        ];
    }
}
