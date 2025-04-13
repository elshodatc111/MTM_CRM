<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CancelVacancyChildRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'vacancy_child_id' => 'required|integer|exists:vacancy_children,id',
            'comment' => 'required|string|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'vacancy_child_id.required' => 'Vakansiya ID ko‘rsatilmagan.',
            'vacancy_child_id.exists' => 'Ko‘rsatilgan vakansiya topilmadi.',
            'comment.required' => 'Bekor qilish sababi majburiy.',
            'comment.max' => 'Sabab 1000 ta belgidan oshmasligi kerak.',
        ];
    }
}
