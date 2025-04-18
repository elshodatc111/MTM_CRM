<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymartStoreRequest extends FormRequest{
    public function authorize(): bool{
        return true; // Foydalanuvchi ruxsatini tekshirish
    }

    public function rules(): array{
        return [
            'children_id' => 'required|exists:children,id',
            'amount' => 'required',
            'type' => 'required|in:naqt,plastik',
            'discription' => 'required|string|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'children_id.required' => 'Bola ID si topilmadi.',
            'children_id.exists' => 'Bunday bola topilmadi.',
            'amount.required' => 'To‘lov summasi majburiy.',
            'amount.numeric' => 'Summani raqamda kiriting.',
            'type.required' => 'To‘lov turini tanlang.',
            'type.in' => 'Faqat naqt yoki plastik bo‘lishi mumkin.',
            'discription.required' => 'Izoh kiritish majburiy.',
        ];
    }
}
