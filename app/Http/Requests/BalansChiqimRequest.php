<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BalansChiqimRequest extends FormRequest{
    public function authorize(): bool{
        return true; 
    }

    public function rules(): array{
        return [
            'balans_naqt' => 'required',
            'balans_plastik' => 'required',
            'amount' => 'required',
            'type' => 'required|in:moliya_chiqim_naqt,moliya_chiqim_pastik,moliya_xarajat_naqt,moliya_xarajat_plastik',
            'start_description' => 'required|string|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'amount.required' => 'Chiqim summasi kiritilishi shart.',
            'amount.numeric' => 'Chiqim summasi raqam bo‘lishi kerak.',
            'type.required' => 'Chiqim turi tanlanishi shart.',
            'start_description.required' => 'Tavsif kiritilishi kerak.',
        ];
    }
}
