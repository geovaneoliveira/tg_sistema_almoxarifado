<?php

namespace App\Http\Controllers;
use Request;
use App\Tipo;
use App\Estoque;
use App\Material;
use App\requisicao;
use App\MaterialRequisitado;

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
        $myJson = Request::route('json');
        $myObj = json_decode($myJson);
        $listaMateriais = Material::listarMateriaisOnde($myObj->nome_material, $myObj->cod_tipo );
        return response()->json($listaMateriais); 
    }


    public function requisita() {
        $myJson = Request::route('json');
        $materiaisRequisitados = json_decode($myJson);

        if( count($materiaisRequisitados) > 0 ) {
            $requisicao = new Requisicao();
            $requisicao->cod_usuario = \Auth::user()->id;
            $requisicao->situacao = "Aberta";
            $requisicao->save();

            foreach ($materiaisRequisitados as $m) {
                $materialRequisitado = new MaterialRequisitado();
                $materialRequisitado->cod_requisicao = $requisicao->cod_requisicao;
                $materialRequisitado->cod_material = $m->cod_material;
                $materialRequisitado->quantidade_req = $m->quantidade;
                $materialRequisitado->save();
            }

            return $requisicao->cod_requisicao;

        }

    }

    


}
