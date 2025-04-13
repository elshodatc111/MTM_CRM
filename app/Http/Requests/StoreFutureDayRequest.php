<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFutureDayRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'days' => 'required|date|after_or_equal:today|unique:days,days',
            'description' => 'required|string|max:255',
        ];
    }

    public function messages(): array{
        return [
            'days.after_or_equal' => 'Faqat bugungi yoki kelajakdagi sanalarni kiriting.',
            'date.unique' => 'Bu sana allaqachon kiritilgan.',
        ];
    }

    public function attributes(): array{
        return [
            'days' => 'Dam olish kuni',
            'description' => 'Dam olish kuni haqida',
        ];
    }
}
