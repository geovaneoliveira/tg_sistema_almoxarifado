<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstoqueRequest extends FormRequest
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
            'cod_material'  => 'required',
            'cod_local'     => 'required',
            'lote'          => 'required',
            'quantidade'    => 'required',
            'data_validade' => 'nullable|date'
        ];
    }




    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'date'      => 'Digite uma data válida',
        ];

    }



}
