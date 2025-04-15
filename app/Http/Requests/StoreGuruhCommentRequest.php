<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuruhCommentRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'guruh_id' => 'required|exists:guruhs,id',
            'comment' => 'required|string|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'guruh_id.required' => 'Guruh ID majburiy.',
            'guruh_id.exists' => 'Bunday guruh topilmadi.',
            'comment.required' => 'Izoh matni majburiy.',
            'comment.string' => 'Izoh matni matn bo‘lishi kerak.',
            'comment.max' => 'Izoh 1000 belgidan oshmasligi kerak.',
        ];
    }
}
