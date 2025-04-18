<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentChildBolaRequest extends FormRequest{
    public function authorize(): bool{
        return true; // kerak bo'lsa, autentifikatsiyani tekshirishni shu yerda qilasiz
    }

    public function rules(): array{
        return [
            'children_id' => 'required|integer|exists:children,id',
            'description' => 'required|string|min:3|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'children_id.required' => 'Farzand ID majburiy.',
            'children_id.integer' => 'Farzand ID butun son bo\'lishi kerak.',
            'children_id.exists' => 'Bunday farzand topilmadi.',
            'description.required' => 'Izoh matni majburiy.',
            'description.min' => 'Izoh kamida :min ta belgidan iborat bo\'lishi kerak.',
            'description.max' => 'Izoh :max ta belgidan oshmasligi kerak.',
        ];
    }
}
