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
		$requisicoes = Requisicao::all();

        return view('minhas-requisicoes')
                ->with('view', $this->view)
                ->with('requisicoes', $requisicoes);
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
/*
        $cod_requisicao = Request::input('cod_requisicao');
        $cod_usuario =  \Auth::user()->id;
        $situacao = Request::input('situacao');
        $data_req_inicial = Request::input('data_req_inicial');
        $data_req_final = Request::input('data_req_final');
        $data_atend_inicial = Request::input('data_atend_inicial');
        $data_atend_final = Request::input('data_atend_final');

        $requisicoes = requisicao::listarRequisicoesOnde( $cod_requisicao,
                                                          $cod_usuario, 
                                                          $situacao, 
                                                          $data_req_inicial,
                                                          $data_req_final,
                                                          $data_atend_inicial,
                                                          $data_atend_final
                                                        );
                                                        */
        $requisicoes = Requisicao::all();

        return view('minhas-requisicoes')
                ->with('view', $this->view)
                ->with('requisicoes', $requisicoes);

    }


}
