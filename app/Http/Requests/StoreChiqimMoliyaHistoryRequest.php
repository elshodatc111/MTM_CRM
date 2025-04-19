<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChiqimMoliyaHistoryRequest extends FormRequest{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'kassa_naqt' => ['required'],
            'kassa_plastik' => ['required'],
            'amount' => ['required'],
            'type' => ['required', 'in:kassa_chiqim_naqt,kassa_chiqim_pastik'],
            'start_description' => ['required', 'string', 'max:1000'],
        ];
    }

    public function messages(){
        return [
            'amount.required' => 'Chiqim summasi kiritilishi shart.',
            'amount.numeric' => 'Chiqim summasi faqat raqam bo‘lishi kerak.',
            'amount.min' => 'Chiqim summasi 0 dan katta bo‘lishi kerak.',
            'type.required' => 'Chiqim turi tanlanishi kerak.',
            'type.in' => 'Noto‘g‘ri chiqim turi tanlandi.',
            'start_description.required' => 'Chiqim haqida ma’lumot yozilishi kerak.',
        ];
    }
}
