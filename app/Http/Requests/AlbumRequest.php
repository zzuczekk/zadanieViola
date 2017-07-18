<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'release_date' => 'required',
            'artist_id' => 'required',
            'CategoryList' => 'required',
            'cover'=>'required'

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pole nazwa jest wymagane!',
            'description.required' => 'Pole opis jest wymagane!',
            'cover.required' => 'Okładka jest wymagana!',
            'release_date.required' => 'Pole data premiery jest wymagane!',
            'artist_id.required' => 'Pole artysta jest wymagane!',
            'CategoryList.required' => 'Wybierz przynajmniej jedną kategorie!',

        ];
    }
}
