<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefundStoreRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'children_id' => 'required|exists:children,id',
            'kassa_naqt' => 'required|numeric|min:0',
            'kassa_plastik' => 'required|numeric|min:0',
            'amount' => 'required',
            'type' => 'required|in:naqt,plastik',
            'comment' => 'required|string|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'children_id.required' => 'Bola ID topilmadi.',
            'amount.required' => 'Qaytariladigan summa kiritilishi kerak.',
            'amount.numeric' => 'Summani raqamda kiriting.',
            'amount.min' => 'Minimal qaytariladigan summa 0.01 bo‘lishi kerak.',
            'type.required' => 'To‘lov turi tanlanishi kerak.',
            'type.in' => 'Faqat naqt yoki plastik bo‘lishi mumkin.',
            'comment.required' => 'Qaytarish haqida izoh yozing.',
        ];
    }
}
