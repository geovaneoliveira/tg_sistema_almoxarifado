<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MateriaisRequest extends FormRequest
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
            'nome_material' => 'required|max:50',
            'cod_tipo'      => 'required',
            'cod_unid_medida' => 'required',
            'lead_time' => 'required|numeric',
            'cons_dia' => 'required|numeric',
            'margem_seg' => 'required|numeric',
            'percentual_seg' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O :attribute é obrigatório'
        ];
    }
}
