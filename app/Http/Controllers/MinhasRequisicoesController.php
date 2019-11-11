<?php

namespace App\Http\Controllers;
use Request;
use App\Tipo;

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
		return view('minhas-requisicoes')->with('view', $this->view);
	}

    public function exibeDetalhes() {
        return view('requisicao-detalhes')->with('view', $this->view);
    }

    public function edita() {
        return view('requisicao')->with('view', $this->view)->with('operacao', 'edita');
    }

    public function remove() {
    }

}
