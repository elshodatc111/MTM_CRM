<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentChildRequest extends FormRequest{
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
            'vacancy_child_id.required' => 'Vakansiya ID majburiy.',
            'vacancy_child_id.exists' => 'Bunday vakansiya topilmadi.',
            'comment.required' => 'Izoh matni majburiy.',
            'comment.max' => 'Izoh 1000 ta belgidan oshmasligi kerak.',
        ];
    }
}
