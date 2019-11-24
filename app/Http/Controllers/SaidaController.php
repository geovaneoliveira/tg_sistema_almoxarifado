<?php

namespace App\Http\Controllers;
use Request;
use App\Tipo;
use App\Requisicao;
use App\User;

class SaidaController extends Controller
{
    public $view = [
        "active" => "saida"
    ];

	public function __construct()
    {
        $this->middleware('autorizacao');
    }

    public function abreForm() {
		return view('saida-consulta-de-requisicoes')->with('view', $this->view);
	}


    public function localiza() {
        $nome_requisitante = Request::input('nome_requisitante');
        
       // return $requisitantes;

        $cod_requisicao = Request::input('cod_requisicao');
        
        $situacao = Request::input('situacao');
        $data_req_inicial = Request::input('data_req_inicial');
        $data_req_final = Request::input('data_req_final');
        $data_atend_inicial = Request::input('data_atend_inicial');
        $data_atend_final = Request::input('data_atend_final');

        $requisicoes = Requisicao::where('cod_requisicao',  'like' , '%' . $cod_requisicao . '%' );

        if ($nome_requisitante) {
            $requisitantes = User::where('name', 'like' , '%' . $nome_requisitante . '%' )->select('id')->get();
            $requisicoes->whereIn('cod_usuario',  $requisitantes);
        }

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

        return view('saida-consulta-de-requisicoes')
                ->with('view', $this->view)
                ->with('requisicoes', $requisicoes);         

    }


    public function atende() {
        return view('saida-atender-requisicao')->with('view', $this->view);
    }


    public function nega() {
        $status = '';

        try {
            $cod_requisicao = Request::route('cod_requisicao');
            $requisicao = Requisicao::find($cod_requisicao);
            $requisicao->situacao = 'Negada'; 
            $requisicao->save(); 
            $status = 'negada';          
        } catch (Exception $e) {
            $status = 'naoNegada';            
        }

        return view('saida-consulta-de-requisicoes')
                                ->with('status', $status)
                                ->with('view', $this->view);
    }



    public function exibeDetalhes() {
        $cod_requisicao = Request::route('cod_requisicao');
        $requisicao = Requisicao::find($cod_requisicao);
        return view('requisicao-detalhes')
                        ->with('view', $this->view)
                        ->with('requisicao', $requisicao);
    }









}