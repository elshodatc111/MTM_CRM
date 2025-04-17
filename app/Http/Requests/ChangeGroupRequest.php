<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeGroupRequest extends FormRequest
{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'id' => 'required|exists:children,id', // jadval nomiga qarab o‘zgartirishingiz mumkin
            'guruh_id' => 'required|exists:guruhs,id', // groups jadval nomi
            'end_description' => 'required|string|min:5',
        ];
    }

    public function messages(): array{
        return [
            'id.required' => 'Bola ID topilmadi.',
            'id.exists' => 'Bunday bola mavjud emas.',
            'guruh_id.required' => 'Yangi guruh tanlanmagan.',
            'guruh_id.exists' => 'Bunday guruh mavjud emas.',
            'end_description.required' => 'Guruhni almashtirish haqida yozing.',
            'end_description.min' => 'Tavsif kamida 5 ta belgidan iborat bo‘lishi kerak.',
        ];
    }
}
