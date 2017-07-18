<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'oldpassword'=>'required|chceckpassword',
            'newpassword' => 'required|string|min:6|confirmed',
        ];
    }
    public function messages()
    {
        return [
            'oldpassword.required'=>'Pole stare hasło jest wymagane',
            'oldpassword.chceckpassword'=>'To nie jest twoje aktualne hasło',
            'newpassword.required'=>'Pole nowe hasło jest wymagane',
            'newpassword.min'=>'Nowe hasło musi mieć minimum 6 znaków',
            'newpassword.confirmed'=>'Hasła nie są takie same'
        ];
    }
}
