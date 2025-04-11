<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HodimCreateRequest extends FormRequest{
    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        //'admin','meneger','tarbiyachi','kichik_tarbiyachi','oshpaz','qarovul','bogbon','farrosh','techer'
        return [
            'name' => 'required|string|max:255',
            'addres' => 'required|string|max:255',
            'phone' => 'required|string|max:17', 
            'birthday' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'decription' => 'required|string',
            'type' => 'required|in:admin,meneger,tarbiyachi,kichik_tarbiyachi,oshpaz,qarovul,bogbon,farrosh,techer',
        ];
    }
    public function messages(): array{
        return [
            'name.required' => 'FIO maydoni talab qilinadi.',
            'addres.required' => 'Yashash manzili maydoni talab qilinadi.',
            'phone.required' => 'Telefon raqami maydoni talab qilinadi.',
            'birthday.required' => 'Tug‘ilgan sana maydoni talab qilinadi.',
            'email.required' => 'Email maydoni talab qilinadi.',
            'decription.required' => 'Meneger haqida maydoni talab qilinadi.',
            'email.unique' => 'Bu email bilan foydalanuvchi allaqachon mavjud.',
        ];
    }
}
