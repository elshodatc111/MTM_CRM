<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGroupRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }
    public function rules(): array{
        return [
            'name' => 'required|string|max:255',
            'amount' => ['required', 'regex:/^[1-9]\d*(\s\d{3})*$/'],
            'katta_tarbiyachi' => 'required|numeric|min:0|max:100',
            'kichik_tarbiyachi' => 'required|numeric|min:0|max:100',
        ];
    }
    public function messages(): array{
        return [
            'amount.regex' => 'Guruh narxi noto‘g‘ri formatda kiritilgan (masalan: 1 000 000).',
        ];
    }
}
