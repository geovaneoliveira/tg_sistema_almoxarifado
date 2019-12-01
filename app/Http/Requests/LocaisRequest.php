<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocaisRequest extends FormRequest
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
            'nome_local' => 'required|min:3|max:20|unique:locais'
        ];
    }




    public function messages()
    {
        return [
            'required' => 'O compo :attribute é obrigatório',
            'min'      => 'O campo :attribute precisa ter mais do que três caracteres',
            'max'      => 'O campo :attribute não pode exceder 20 caracteres',
            'unique'   => 'O :attribute já foi utilizado'
        ];

    }



}
