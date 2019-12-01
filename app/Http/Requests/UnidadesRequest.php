<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadesRequest extends FormRequest
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
            'descricao_unid_medida' => 'required|min:2|max:20|unique:unidade_medida'
        ];
    }




    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'min'      => 'O campo :attribute precisa terpelo menos 2 caracteres',
            'max'      => 'O campo :attribute não pode exceder 20 caracteres',
            'unique'   => 'O :attribute já foi utilizado'
        ];

    }



}
