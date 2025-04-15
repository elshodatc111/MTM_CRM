<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTarbiyachiRequest extends FormRequest{
    public function authorize(): bool{
        return true; // Agar faqat admin ruxsati kerak bo‘lsa, bu yerda tekshirsa bo‘ladi
    }

    public function rules(): array{
        return [
            'guruh_id' => 'required|exists:guruhs,id',
            'user_id' => 'required|exists:users,id',
            'end_description' => 'required|string|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'guruh_id.required' => 'Guruh ID majburiy.',
            'guruh_id.exists' => 'Bunday guruh mavjud emas.',
            'user_id.required' => 'Iltimos, tarbiyachini tanlang.',
            'user_id.exists' => 'Tanlangan tarbiyachi topilmadi.',
            'end_description.required' => 'Izoh matni majburiy.',
            'end_description.max' => 'Izoh matni juda uzun.',
        ];
    }
}
