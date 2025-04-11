<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVacancyRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'name' => 'required|string|max:255',
            'addres' => 'required|string|max:255',
            'phone' => 'required|string',
            'birthday' => 'required|date|before:today',
            'type' => 'required|in:oshpaz,qarovul,bogbon,farrosh,techer',
            'worked' => 'required|string|max:2000', 
            'decription' => 'required|string|max:2000', 
        ];
    }
    public function messages(): array{
        return [
            'phone.regex' => 'Telefon raqam +998 bilan boshlanib, jami 13 belgidan iborat bo‘lishi kerak.',
            'type.in' => 'Noto‘g‘ri lavozim tanlandi.',
        ];
    }
}
