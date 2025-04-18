<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountStoreRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'children_id' => 'required|exists:children,id',
            'amount' => 'required',
            'comment' => 'required|string|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'children_id.required' => 'Bola ID topilmadi.',
            'children_id.exists' => 'Bunday bola bazada mavjud emas.',
            'amount.required' => 'Chegirma summasi majburiy.',
            'amount.numeric' => 'Chegirma summasi raqam bo‘lishi kerak.',
            'amount.min' => 'Minimal chegirma summasi 0.01 bo‘lishi kerak.',
            'comment.required' => 'Izoh yozilishi shart.',
            'comment.max' => 'Izoh 1000 belgidan oshmasligi kerak.',
        ];
    }
}
