<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemoveChildRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'guruh_id' => 'required|exists:guruhs,id',
            'children_id' => 'required|exists:children,id',
            'end_description' => 'required|string|min:5',
        ];
    }

    public function messages(): array{
        return [
            'guruh_id.required' => 'Guruh ID bo‘lishi shart.',
            'guruh_id.exists' => 'Guruh topilmadi.',
            'children_id.required' => 'Bola tanlanmagan.',
            'children_id.exists' => 'Bunday bola mavjud emas.',
            'end_description.required' => 'Sababni yozing.',
            'end_description.min' => 'Sabab kamida 5 ta belgidan iborat bo‘lishi kerak.',
        ];
    }
}
