<?php

namespace App\Http\Controllers;
use Request;
use App\Tipo;

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
		return view('saida-consulta-de-requisicoes')->with('view', $this->view)->with('operacao', 'abreForm');
	}

    public function exibeDetalhes() {
        return view('requisicao-detalhes')->with('view', $this->view);
    }

    public function atende() {
        return view('saida-atender-requisicao')->with('view', $this->view);
    }

}
