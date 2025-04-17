<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuardianRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'child_id' => 'required|exists:children,id',
            'kim' => 'required|string|max:50',
            'name' => 'required|string|max:100',
            'phone1' => 'required|string',
            'phone2' => 'required|string',
        ];
    }

    public function messages(): array{
        return [
            'child_id.required' => 'Bola ID kiritilishi shart.',
            'child_id.exists' => 'Bunday bola topilmadi.',
            'kim.required' => 'Vasiy kimligini yozing (masalan, Otasi).',
            'name.required' => 'FIO kiritilishi shart.',
            'phone1.required' => 'Asosiy telefon raqami kiritilishi shart.',
            'phone1.regex' => 'Telefon raqam +998 bilan va 9 raqam bilan yozilishi kerak.',
            'phone2.required' => 'Qo‘shimcha telefon raqami kiritilishi shart.',
            'phone2.regex' => 'Qo‘shimcha telefon raqam ham +998 bilan va 9 raqam bilan yozilishi kerak.',
        ];
    }
}
