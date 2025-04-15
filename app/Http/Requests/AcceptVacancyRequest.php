<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcceptVacancyRequest extends FormRequest
{
    public function authorize(): bool{
        return true; 
    }

    public function rules(): array{
        return [
            'vacancy_child_id'   => 'required|exists:vacancy_children,id',
            'guruh_id'           => 'required|exists:guruhs,id',
            'qarindosh'  => 'required|string|max:1000',
            'fio'  => 'required|string|max:1000',
            'phone1'  => 'required|string|max:1000',
            'phone2'  => 'required|string|max:1000',
            'start_description'  => 'required|string|max:1000',
        ];
    }

    public function messages(): array{
        return [
            'phone1.required'  => 'Telefon raqamini kiritish majburiy.',
            'phone2.required'  => 'Telefon raqamini kiritish majburiy.',
            'vacancy_child_id.required'  => 'Bo‘sh ish o‘rni ID topilmadi.',
            'vacancy_child_id.exists'    => 'Berilgan ID bo‘yicha bo‘sh ish o‘rni mavjud emas.',
            'guruh_id.required'          => 'Iltimos, qabul qilinadigan guruhni tanlang.',
            'guruh_id.exists'            => 'Tanlangan guruh mavjud emas.',
            'start_description.required' => 'Qabul qilish sababi majburiy.',
            'start_description.max'      => 'Qabul qilish sababi 1000 belgidan oshmasligi kerak.',
        ];
    }
}
