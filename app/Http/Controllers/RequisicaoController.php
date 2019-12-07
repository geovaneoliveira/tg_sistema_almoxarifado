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

	public function __construct() {
        
        $this->middleware('autorizacao');

        if(\App\Inventario::where('data_fim', '=', null)->count() > 0 ) {
            $this->view['inventario'] = true;
        } else {
            $this->view['inventario'] = false;
        }
        
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
        $cod_requisicao = Request::route('cod_requisicao');

        if ($cod_requisicao > 0) {
            $requisicao = Requisicao::find($cod_requisicao);
            foreach ($requisicao->materiais_requisitados as $mr) {
                $mr->delete();
            }

        } else {
            $requisicao = new Requisicao();
            $requisicao->cod_usuario = \Auth::user()->id;
            $requisicao->situacao = "Aberta";
            $requisicao->save();
        }

        $jsonMateriais = Request::route('jsonMateriais');
        $materiaisRequisitados = json_decode($jsonMateriais);

        if( count($materiaisRequisitados) > 0 ) {
            foreach ($materiaisRequisitados as $m) {
                $materialRequisitado = new MaterialRequisitado();
                $materialRequisitado->cod_requisicao = $requisicao->cod_requisicao;
                $materialRequisitado->cod_material = $m->cod_material;
                $materialRequisitado->quantidade_req = $m->quantidade_req;
                $materialRequisitado->save();
            }
            return $requisicao->cod_requisicao;
        }

        return 'ERRO ao tentar salvar Requisição.';
    }



}
