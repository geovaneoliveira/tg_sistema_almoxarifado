<?php

namespace App\Http\Controllers;
use Request;
use App\Requisicao;

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
        return view('requisicao-detalhes')->with('view', $this->view);
    }

    public function edita() {
        return view('requisicao')->with('view', $this->view)->with('operacao', 'edita');
    }

    public function remove() {
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
            $requisicoes->whereDate('data_req', '<=', $data_req_inicial);
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


}
