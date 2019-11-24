<?php

namespace App\Http\Controllers;
use Request;
use App\Requisicao;
use App\Tipo;
use App\MaterialRequisitado;

class MinhasRequisicoesController extends Controller
{
    public $view = [
        "active" => "minhas-requisicoes"
    ];

	public function __construct()
    {
        $this->middleware('autorizacao');
    }

    public function abreForm() {
		return view('minhas-requisicoes')
                ->with('view', $this->view);
	}

    public function exibeDetalhes() {
        $cod_requisicao = Request::route('cod_requisicao');
        $requisicao = Requisicao::find($cod_requisicao);
        return view('requisicao-detalhes')
                        ->with('view', $this->view)
                        ->with('requisicao', $requisicao);
    }

    public function edita() {
        $cod_requisicao = Request::route('cod_requisicao');
        $requisicao = Requisicao::find($cod_requisicao);
        return view('requisicao')
                                ->with('view', $this->view)
                                ->with('tipos', Tipo::all())
                                ->with('requisicao', $requisicao)
                                ->with('operacao', 'edita');
    }

    public function remove() {
        $cod_requisicao = Request::route('cod_requisicao');
        $status = '';
        try {            
            $requisicao = Requisicao::find($cod_requisicao);
            if ($requisicao->situacao == 'Aberta') {
                foreach ($requisicao->materiaisRequisitados as $mt) {
                    $mt->delete();
                }
                $requisicao->delete();
                $status = 'excluido';
            }
        } catch (\Exception $e) {
            $status = 'naoExcluido';
            
        }
            return view('minhas-requisicoes')
                    ->with('view', $this->view)
                    ->with('status', $status);

    }


    public function localiza() {

        $cod_requisicao = Request::input('cod_requisicao');
        $cod_usuario =  \Auth::user()->id;
        $situacao = Request::input('situacao');

        $data_req_inicial = Request::input('data_req_inicial');
        $data_req_final = Request::input('data_req_final');
        $data_atend_inicial = Request::input('data_atend_inicial');
        $data_atend_final = Request::input('data_atend_final');

        $requisicoes = Requisicao::where('cod_requisicao',  'like' , '%' . $cod_requisicao . '%' )
                                    ->where('cod_usuario',  $cod_usuario );
        if ($situacao) {
            $requisicoes->where('situacao', $situacao);
        }

        if ($data_req_inicial) {
            $requisicoes->whereDate('data_req', '>=', $data_req_inicial);
        }

        if ($data_req_final) {
            $requisicoes->whereDate('data_req', '<=', $data_req_final);
        }

        if ($data_atend_inicial) {
            $requisicoes->whereDate('data_atend', '>=', $data_atend_inicial);
        }

        if ($data_atend_final) {
            $requisicoes->whereDate('data_atend', '<=', $data_atend_final);
        }

        $requisicoes = $requisicoes->orderBy('cod_requisicao', 'desc')->get();

        return view('minhas-requisicoes')
                ->with('view', $this->view)
                ->with('requisicoes', $requisicoes);

    }




    public function localizaMateriaisRequisitados () {
        $cod_requisicao = Request::route('cod_requisicao');
        $materiaisRequisitados = MaterialRequisitado::listarMateriaisRequisitadosOnde($cod_requisicao);
        return response()->json( $materiaisRequisitados );        
    }





}
