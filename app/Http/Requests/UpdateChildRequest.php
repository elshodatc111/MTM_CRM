<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChildRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'id' => 'required|exists:children,id',
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'birthday' => 'required|date|before:today',
            'description' => 'required|string',
        ];
    }

    public function messages(): array{
        return [
            'id.required' => 'Bola ID topilmadi.',
            'id.exists' => 'Bunday bola mavjud emas.',
            'name.required' => 'FIO kiritilishi shart.',
            'address.required' => 'Yashash manzili kiritilishi shart.',
            'birthday.required' => 'Tug‘ilgan sana kiritilishi kerak.',
            'birthday.before' => 'Tug‘ilgan sana bugungi kundan oldin bo‘lishi kerak.',
            'description.required' => 'Tavsif yozilishi kerak.',
        ];
    }
}
