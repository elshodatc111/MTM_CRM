<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuruhRequest extends FormRequest{
    public function authorize(): bool{
        return true; 
    }

    public function rules(): array{
        return [
            'guruh_id' => 'required|exists:guruhs,id', 
            'name' => 'required|string|max:255',
            'amount' => 'required',
            'katta_tarbiyachi' => 'required|numeric|min:0|max:100',
            'kichik_tarbiyachi' => 'required|numeric|min:0|max:100',
        ];
    }

    public function messages(): array{
        return [
            'guruh_id.required' => 'Guruh ID topilmadi.',
            'guruh_id.exists' => 'Guruh mavjud emas.',
            'name.required' => 'Guruh nomi majburiy.',
            'amount.required' => 'Guruh narxi kiritilishi kerak.',
            'katta_tarbiyachi.required' => 'Katta tarbiyachi foizi kerak.',
            'katta_tarbiyachi.max' => 'Katta tarbiyachi uchun maksimal 100% kiritish mumkin.',
            'kichik_tarbiyachi.required' => 'Yordamchi tarbiyachi foizi kerak.',
            'kichik_tarbiyachi.max' => 'Yordamchi tarbiyachi uchun maksimal 100% kiritish mumkin.',
        ];
    }
}
