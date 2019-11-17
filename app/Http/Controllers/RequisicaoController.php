<?php

namespace App\Http\Controllers;
use Request;
use App\Tipo;
use App\Estoque;
use App\Material;

class RequisicaoController extends Controller
{
    public $view = [
        "active" => "requisicao"
    ];

	public function __construct()
    {
        $this->middleware('autorizacao');
    }

    public function abreForm() {
		return view('requisicao')
                                ->with('view', $this->view)
                                ->with('tipos', Tipo::all())
                                ->with('operacao', 'abreForm');
	}

    public function localizaEstocados() {
        $myJson = Request::route('jSon');
        $myObj = json_decode($myJson);
        $listaMateriais = Material::listarMateriaisOnde($myObj->nome_material, $myObj->cod_tipo );
        return response()->json($listaMateriais); 
    }


}
