<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone1' => 'required|string',
            'phone2' => 'required|string',
            'birthday' => 'required|date',
            'description' => 'required|string',
        ];
    }
    public function messages(): array{
        return [
            'phone1.regex' => 'Telefon raqami formati +998 XX XXX XXXX ko‘rinishida bo‘lishi kerak.',
            'phone2.regex' => 'Qo‘shimcha telefon raqami formati +998 XX XXX XXXX bo‘lishi kerak.',
        ];
    }
}
